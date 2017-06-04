<?php 

namespace App\Repositories;

interface CommentRepositoryInterface {

    public function voteById($id, $vote);

}