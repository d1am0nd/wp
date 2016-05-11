<?php 

namespace App\Repositories;

use DB;
use Auth;
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
        return $this->selectImportant($query, $forPage)->paginate(15, '*', null, $forPage)->selectImportant($query);
    }

    private function selectImportant(&$query, $forPage)
    {
        return $query
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
            Auth::check() ? 'my_vote.vote as my_vote' : DB::raw('0 as my_vote'),
        ]);
    }
    
}