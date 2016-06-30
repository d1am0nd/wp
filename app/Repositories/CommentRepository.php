<?php 

namespace App\Repositories;

use App\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function voteById($id, $vote)
    {
        return $this->comment->findOrFail($id)
        ->vote($vote);
    }
}