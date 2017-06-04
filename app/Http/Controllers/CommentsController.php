<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests;
use App\Http\Requests\VoteRequest;
use App\Repositories\CommentRepositoryInterface;

class CommentsController extends Controller
{
    protected $comments;

    public function __construct(CommentRepositoryInterface $comments)
    {
        $this->comments = $comments;
    }

    public function postVote(VoteRequest $request, $id)
    {
        return $this->comments->voteById($id, $request->input('vote'));
        return $comment->vote($request->input('vote'));
    }
}
