<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardText extends Model
{
    protected $fillable = ['name', 'text', 'card_id', 'card_language_id'];

    public function card()
    {
        return $this->hasOne(Card::class);
    }

    public function language()
    {
        return $this->hasOne(CardLanguage::class);
    }
}
