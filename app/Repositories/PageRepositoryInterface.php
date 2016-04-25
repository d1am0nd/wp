<?php 

namespace App\Repositories;

interface PageRepositoryInterface{

    public function getPagesWithInfo($forPage = 1, $tag = null, $orderBy = null);

}