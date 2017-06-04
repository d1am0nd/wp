<?php 

namespace App\Repositories;

use App\Tag;

class TagRepository implements TagRepositoryInterface {

    public function getTags()
    {
        return Tag::select([
                'id',
                'name'
            ])
            ->get();
    }

}