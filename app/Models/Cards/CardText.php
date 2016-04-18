<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardText extends Model
{
    public function card()
    {
        return $this->hasOne(Card::class);
    }

    public function language()
    {
        return $this->hasOne(CardLanguage::class);
    }
}
