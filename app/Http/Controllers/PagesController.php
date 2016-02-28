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
use App\Http\Requests\Pages\StorePagesRequest;

class PagesController extends Controller
{
    use VoteTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $pages = Page::whereHasTags($filter)->withVotesOrder()->get();
        return view('pages.index', compact('pages', 'filter'));
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
    public function store(StorePagesRequest $request)
    {
        $newUser = array_merge($request->only('url', 'description', 'title'), ['thumbnail_path' => '/hslogo.jpg']);
        Video::unguard();
        $page = \Auth::user()->pages()->create($newUser);
        Video::reguard();

        $tag_ids = array_map('intval', $request->input('tag_id'));
        $page->tags()->attach($tag_ids);

        \Artisan::call('page:updateThumbnail', [
            'id' => $page->id, 'url' => $request->input('url')
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

    public function postVote(VoteRequest $request, Page $page)
    {
        return $this->vote($request, $page);
    }
}
