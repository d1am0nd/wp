<?php 

namespace App\Repositories;

interface PageTypeRepositoryInterface{

    public function getTypes();

    public function getTypeByName($name);

}