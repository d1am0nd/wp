<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\Page;
use App\Video;
use App\Http\Requests;
use App\Http\Requests\VoteRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Traits\Controllers\VoteTrait;
use App\Repositories\VideoRepositoryInterface;
use App\Http\Requests\Videos\StoreVideosRequest;

class VideosController extends Controller
{
    use VoteTrait;

    public function __construct(VideoRepositoryInterface $videos)
    {
        $this->videos = $videos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('videos.angindex');
        
        /**
         * Old implementation
         */
        
        /*
        $filterTag = $request->input('tag');
        $filterOrderBy = $request->input('orderBy');
        $videos = Video::filterOrderBy($filterOrderBy)->withMyVote()->whereHasTag($filterTag)->paginate(20);
        return view('videos.index', compact('videos', 'filterTag', 'filterOrderBy'));
        */
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
        $newVideo = array_merge(
            $request->only('url', 'description', 'title'), 
            ['thumbnail_path' => '/hslogo.jpg', 'slug' => str_slug($request->input('title'), '-')]
        );
        Video::unguard();
        $video = \Auth::user()->videos()->create($newVideo);
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
    public function show($videoSlug)
    {
        $video = Video::with([
            'comments' => function($q) use($videoSlug) {
                return $q->withMyVote();
            }
        ])->where('slug', $videoSlug)->first();
        return view('videos.show')->with(compact('video'));;
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

    public function postComment(CommentRequest $request, Video $video)
    {
        $video->comment($request->input('text'));
        return redirect()->back();
    }

    public function postVote(VoteRequest $request, Video $video)
    {
        return $this->vote($request, $video);
    }

    public function getVideosJson(Request $request)
    {
        $filterPage = $request->has('page') ? $request->input('page') : 1;
        $filterTag = $request->has('tag') ?  $request->input('tag') : null;
        $filterOrderBy = $request->input('orderBy') ? $request->input('orderBy') : null;
        $filterTitle = $request->input('title') ? $request->input('title') : null;
        if(isset($filterTitle))
            return $this->videos->getVideosWithInfoByTitle($filterTitle, $filterPage, $filterTag, $filterOrderBy)->toJson();
        return $this->videos->getVideosWithInfo($filterPage, $filterTag, $filterOrderBy)->toJson();
    }
    
    public function getVideos()
    {
        return view('videos.angindex');
    }
}
