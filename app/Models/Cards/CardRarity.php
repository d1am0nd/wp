<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardRarity extends Model
{
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
