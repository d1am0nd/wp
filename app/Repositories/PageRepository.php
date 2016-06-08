<?php 

namespace App\Repositories;

use DB;
use Auth;
use App\Page;

class PageRepository implements PageRepositoryInterface{

    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null)
    {
        $this->page->filterOrderBy($orderBy)
            ->withMyVote()
            ->whereHasTag($tag);
        $this->selectImportant();
        return $this->paginate($forPage);
    }

    public function getPagesWithInfoByTitle($title, $forPage = 1, $tag = null, $orderBy = null)
    {
        $this->page->filterOrderBy($orderBy)
            ->withMyVote()
            ->whereHasTag($tag)
            ->where('title', 'LIKE', '%' . $title . '%');
        $this->selectImportant();
        return $this->paginate($forPage);
    }

    public function createPage($attributes, $type)
    {
        return $page = $this->page->create($attributes);
    }

    private function selectImportant()
    {
        $this->page->select([
            'pages.id',
            'title',
            'description',
            'thumbnail_path',
            'vote_sum',
            'pages.created_at',
            'comment_count',
            'slug',
            'url',
            Auth::check() ? 'my_vote.vote as my_vote' : DB::raw('0 as my_vote'),
        ]);
    }

    private function paginate($forPage)
    {
        return $this->page->paginate(15);
    }
    
}