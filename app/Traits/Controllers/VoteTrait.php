<?php

namespace App\Traits\Controllers;

use App\Page;

trait VoteTrait
{
    public function vote($request, $parent)
    {
        $vote = $request->input('vote');
        if(method_exists($parent, 'vote'))
            return json_encode($parent->vote($vote));
        return json_encode('No vote method');
    }
}
