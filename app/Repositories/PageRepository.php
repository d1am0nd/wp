<?php 

namespace App\Repositories;

use DB;
use Auth;
use App\Page;

class PageRepository implements PageRepositoryInterface{

    protected $page, $importantAttributes;

    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->importantAttributes = [
            'pages.id',
            'title',
            'description',
            'thumbnail_path',
            'vote_sum',
            'pages.created_at',
            'comment_count',
            'slug',
            'url',
            Auth::check() ? DB::raw('COALESCE(my_vote.vote, 0) as my_vote') : DB::raw('0 as my_vote'),
        ];
    }

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null)
    {
        return $this->page->filterOrderBy($orderBy)
            ->withMyVote()
            ->whereHasTag($tag)
            ->select($this->importantAttributes)
            ->paginate(15);
    }

    public function getPagesWithInfoByTitle($title, $forPage = 1, $tag = null, $orderBy = null)
    {
        $this->page->filterOrderBy($orderBy)
            ->withMyVote()
            ->whereHasTag($tag)
            ->where('title', 'LIKE', '%' . $title . '%')
            ->select($this->importantAttributes)
            ->paginate(15);
    }

    public function getPageBySlug($slug)
    {
        return $this->page->where('slug', $slug)
        ->with([
            'comments' => function($q){
                return $q->withMyVote();
            }
        ])
        ->first();
    }

    public function createPage($attributes, $type)
    {
        return $this->page->create($attributes);
    }

    public function postCommentBySlug($slug, $text, $parentId = null)
    {
        return $this->getPageBySlug($slug)->comment($text);
    }

    public function postVoteBySlug($slug, $vote)
    {
        return $this->getPageBySlug($slug)->vote($vote);
    }
}