<?php 

namespace App\Repositories;

use DB;
use Auth;
use App\Video;

class VideoRepository implements VideoRepositoryInterface {

    public function getVideosWithInfo($forPage = 1, $tag = null, $orderBy = null)
    {
        $query = Video::filterOrderBy($orderBy)
        ->withMyVote()
        ->whereHasTag($tag);
        return $this->selectImportant($query, $forPage);
    }

    public function getVideosWithInfoByTitle($title, $forPage = 1, $tag = null, $orderBy = null)
    {
        $query = Video::filterOrderBy($orderBy)
        ->withMyVote()
        ->whereHasTag($tag)
        ->where('title', 'LIKE', '%' . $title . '%');
        return $this->selectImportant($query, $forPage);
    }

    private function selectImportant(&$query, $forPage)
    {
        return $query
        ->select([
            'videos.id',
            'title',
            'description',
            'thumbnail_path',
            'vote_sum',
            'videos.created_at',
            'comment_count',
            'slug',
            'url',
            Auth::check() ? 'my_vote.vote as my_vote' : DB::raw('COALESCE(0) as my_vote'),
        ])
        ->paginate(15, '*', null, $forPage);
    }

}