<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardText extends Model
{
    protected $fillable = ['name', 'text', 'card_id', 'card_language_id'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function cardLanguage()
    {
        return $this->belongsTo(CardLanguage::class);
    }
}
