<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardClass extends Model
{
    protected $table = 'classes';

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
