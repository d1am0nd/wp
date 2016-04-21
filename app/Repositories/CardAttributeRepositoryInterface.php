<?php 

namespace App\Repositories;

interface CardAttributeRepositoryInterface {

    public function getRarities();

    public function getMechanics();

    public function getPlayReqs();

    public function getSets();

    public function getTypes();

    public function getClasses();

}