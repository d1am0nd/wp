<?php 

namespace App\Repositories;

use App\Page;

class PageRepository implements PageRepositoryInterface{

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null)
    {
        $query = Page::filterOrderBy($orderBy)
        ->withMyVote()
        ->whereHasTag($tag);
        return $this->selectImportant($query, $forPage);
    }

    public function getPagesWithInfoByTitle($title, $forPage = 1, $tag = null, $orderBy = null)
    {
        $query = Page::filterOrderBy($orderBy)
        ->withMyVote()
        ->whereHasTag($tag)
        ->where('title', 'LIKE', '%' . $title . '%');
        return $this->selectImportant($query, $forPage);
    }

    private function selectImportant(&$query, $forPage)
    {
        return $query->forPage($forPage, 15)
        ->select([
            'pages.id',
            'title',
            'description',
            'thumbnail_path',
            'vote_sum',
            'pages.created_at',
            'comment_count',
            'slug',
            'url',
            'my_vote.vote as my_vote'
        ])
        ->get();
    }
    
}