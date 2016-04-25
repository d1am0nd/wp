<?php 

namespace App\Repositories;

use App\Page;

class PageRepository implements PageRepositoryInterface{

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null)
    {
        return Page::filterOrderBy($orderBy)
        ->withMyVote()
        ->whereHasTag($tag)
        ->forPage($forPage, 15)
        ->select([
            'pages.id',
            'title',
            'description',
            'thumbnail_path',
            'vote_sum',
            'pages.created_at',
            'comment_count',
            'slug',
            'url'
        ])
        ->get();
    }
    
}