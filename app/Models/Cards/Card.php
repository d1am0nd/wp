<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    // Card has many
    public function cardTexts()
    {
        return $this->hasMany(CardText::class);
    }

    // Many to many
    public function cardMechanics()
    {
        return $this->belongsToMany(CardMechanic::class);
    }

    public function cardPlayReqs()
    {
        return $this->belongsToMany(CardPlayReq::class);
    }

    // Card has one
    public function cardClass()
    {
        return $this->hasOne(CardClass::class);
    }

    public function cardRarity()
    {
        return $this->hasOne(CardRarity::class);
    }

    public function cardSet()
    {
        return $this->hasOne(CardSet::class);
    }

    public function cardType()
    {
        return $this->hasOne(CardType::class);
    }

    // Has many through
    public function languages()
    {
        return $this->hasManyThrough(CardLanguage::class, CardText::class);
    }
}
