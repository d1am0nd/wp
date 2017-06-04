<?php 

namespace App\Repositories;

interface PageRepositoryInterface{

    public function getPagesWithInfo($forPage = 1, $tag = null, $type = null, $orderBy = null);

    public function getPagesWithInfoByTitle($forPage = 1, $title, $tag = null, $type = null, $orderBy = null);

    public function updateThumbnailPathById($id, $path);

    public function createPage($attributes);

    public function getPageBySlug($slug);

    public function postCommentBySlug($slug, $text);

    public function postVoteBySlug($slug, $vote);

}