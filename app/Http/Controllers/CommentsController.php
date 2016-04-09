<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests;
use App\Http\Requests\VoteRequest;

class CommentsController extends Controller
{
    public function postVote(VoteRequest $request, Comment $comment)
    {
        return $comment->vote($request->input('vote'));
    }
}
