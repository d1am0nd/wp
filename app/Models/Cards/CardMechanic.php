<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardMechanic extends Model
{
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
