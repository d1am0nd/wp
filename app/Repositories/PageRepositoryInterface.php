<?php 

namespace App\Repositories;

interface PageRepositoryInterface{

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null);

    public function getPagesWithInfoByTitle($forPage = 1, $title, $tag = null, $orderBy = null);

    public function createPage($attributes, $type);

    public function getPageBySlug($slug);

    public function postCommentBySlug($slug, $text);

    public function postVoteBySlug($slug, $vote);

}