<?php

namespace App\Traits;

use DB;
use Auth;
use App\Vote;
use App\Comment;

trait CommentableTrait
{
    // Relationship definition (One to Many - Polymorphic)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc')->take(20);
    }

    public function comment($text, $parentId = null)
    {
        if(!Auth::check())
            return false;
        $commentArray = [];
        if(isset($parentId))
            $commentArray['comment_id'] = $parentId;
        $commentArray['text'] = $text;
        $commentArray['user_id'] = Auth::user()->id;

        Comment::unguard();
        $this->comments()->create($commentArray);
        Comment::reguard();
        // Increase comment count
        $this->updateCommentCount(1);
        return $text;
    }

    private function updateCommentCount($amount)
    {
        DB::table($this->getTable())->where('id', $this->id)
            ->update(['comment_count' => \DB::raw('comment_count +' . $amount)]);
    }
}
