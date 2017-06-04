<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardLanguage extends Model
{
    protected $table = 'card_languages';

    public function cardTexts()
    {
        return $this->hasMany(CardText::class);
    }
}
