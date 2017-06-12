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

    public function cardText()
    {
        return $this->hasOne(CardText::class);
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
        return $this->belongsTo(CardClass::class);
    }

    public function cardRarity()
    {
        return $this->belongsTo(CardRarity::class);
    }

    public function cardSet()
    {
        return $this->belongsTo(CardSet::class);
    }

    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    // Has many through
    public function languages()
    {
        return $this->hasManyThrough(CardLanguage::class, CardText::class);
    }
}
