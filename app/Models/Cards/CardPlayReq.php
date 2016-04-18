<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardPlayReq extends Model
{
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
