<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tag;
use App\Page;
use App\Video;
use App\Http\Requests;
use App\Http\Requests\VoteRequest;
use App\Http\Controllers\Controller;
use App\Classes\Page\PageTypeHelper;
use App\Http\Requests\CommentRequest;
use App\Traits\Controllers\VoteTrait;
use App\Repositories\PageRepositoryInterface;
use App\Http\Requests\Pages\StorePagesRequest;
use App\Repositories\PageTypeRepositoryInterface;

class PagesController extends Controller
{
    use VoteTrait;

    public function __construct(PageRepositoryInterface $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(StorePagesRequest $request)
    {
        $pth = new PageTypeHelper($request->input('url'));

        /**
         * Merge the attributes from request with 'slug' and 'page_type_id'
         */
        $attributes = array_merge(
            $request->only('url', 'description', 'title'),
            [ 
                'slug' => str_slug($request->input('title')),
                'page_type_id' => $pth->getPageTypeId(),
                'user_id' => Auth::user()->id
            ] 
        );

        $page = $this->pages->createPage($attributes); // Create page

        // Attach tags
        $tagIds = array_map('intval', $request->input('tag_id'));
        $page->tags()->attach($tagIds);

        // Run the command that updates thumbnail for the page
        \Artisan::queue('page:updateThumbnail', [
            'id' => $page->id, 'url' => $request->input('url')
        ]);
        return $page->toJson();
    }


    public function postComment(CommentRequest $request, $slug)
    {
        return $this->pages->postCommentBySlug($slug, $request->input('text'));
    }

    public function postVote(VoteRequest $request, $slug)
    {
        return $this->pages->postVoteBySlug($slug, $request->input('vote'));
    }

    public function getPageJson($slug)
    {
        return $this->pages->getPageBySlug($slug);
    }

    public function getPagesJson(Request $request)
    {
        $filterPage = $request->has('page') ? $request->input('page') : 1;
        $filterTag = $request->has('tag') ?  $request->input('tag') : null;
        $filterOrderBy = $request->has('orderBy') ? $request->input('orderBy') : null;
        $filterTitle = $request->has('title') ? $request->input('title') : null;
        $filterType = $request->has('type') ? $request->input('type') : null;
        if(isset($filterTitle))
            return $this->pages->getPagesWithInfoByTitle($filterTitle, $filterPage, $filterTag, $filterType, $filterOrderBy)->toJson();
        return $this->pages->getPagesWithInfo($filterPage, $filterTag, $filterType, $filterOrderBy)->toJson();
    }
}
