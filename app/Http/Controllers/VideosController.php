<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\Page;
use App\Video;
use App\Http\Requests;
use App\Http\Requests\VoteRequest;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\VoteTrait;
use App\Http\Requests\Videos\StoreVideosRequest;

class VideosController extends Controller
{
    use VoteTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterTag = $request->input('tag');
        $filterOrderBy = $request->input('orderBy');
        $videos = Video::filterOrderBy($filterOrderBy)->withMyVote()->whereHasTag($filterTag)->get();
        return view('videos.index', compact('videos', 'filterTag', 'filterOrderBy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideosRequest $request)
    {
        Video::unguard();
        $video = \Auth::user()->videos()->create($request->only('url', 'description', 'title'));
        Video::reguard();

        $tag_ids = array_map('intval', $request->input('tag_id'));

        $video->tags()->attach($tag_ids);

        // Call commands that gets image thumbnail and updates the model
        \Artisan::queue('video:updateThumbnail', [
            'id' => $video->id, 'url' => $request->input('url')
        ]);
        return json_encode("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postVote(VoteRequest $request, Video $video)
    {
        return $this->vote($request, $video);
    }
}
