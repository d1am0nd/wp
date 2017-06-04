<?php 

namespace App\Repositories;

interface VideoRepositoryInterface {

    public function getVideosWithInfo($forPage = 1, $tag = null, $orderBy = null);

    public function getVideosWithInfoByTitle($forPage = 1, $title, $tag = null, $orderBy = null);

}