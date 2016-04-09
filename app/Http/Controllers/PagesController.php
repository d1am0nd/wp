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
        $filterTag = $request->input('tag');
        $filterOrderBy = $request->input('orderBy');
        $pages = Page::filterOrderBy($filterOrderBy)->withMyVote()->whereHasTag($filterTag)->paginate(15);
        return view('pages.index', compact('pages', 'filterTag', 'filterOrderBy'));
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
        $newPage = array_merge(
            $request->only('url', 'description', 'title'), 
            ['thumbnail_path' => '/hslogo.jpg', 'slug' => str_slug($request->input('title'))]
        );
        Video::unguard();
        $page = \Auth::user()->pages()->create($newPage);
        Video::reguard();

        $tag_ids = array_map('intval', $request->input('tag_id'));
        $page->tags()->attach($tag_ids);

        \Artisan::queue('page:updateThumbnail', [
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
    public function show($pageSlug)
    {
        $page = Page::with([
            'comments' => function($q) use($pageSlug) {
                return $q->withMyVote();
            }
        ])->where('slug', $pageSlug)->first();
        return view('pages.show')->with(compact('page'));
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

    public function postComment(CommentRequest $request, Page $page)
    {
        $page->comment($request->input('text'));
        return redirect()->back();
    }

    public function postVote(VoteRequest $request, Page $page)
    {
        return $page->vote($request->input('vote'));
    }
}
