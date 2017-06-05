<?php

namespace App\Repositories;

use App\Models\Cards\CardSet;
use App\Models\Cards\CardType;
use App\Models\Cards\CardClass;
use App\Models\Cards\CardRarity;
use App\Models\Cards\CardPlayReq;
use App\Models\Cards\CardMechanic;

class CardAttributeRepository implements CardAttributeRepositoryInterface
{
    public function getRarities()
    {
        return CardRarity::get();
    }

    public function getMechanics()
    {
        return CardMechanic::get();
    }

    public function getPlayReqs()
    {
        return CardPlayReq::get();
    }

    public function getSets()
    {
        return CardSet::whereNotIn('name', ['expert1', 'hero_skins'])->get();
    }

    public function getTypes()
    {
        return CardType::whereNotIn('name', ['hero'])->get();
    }

    public function getClasses()
    {
        return CardClass::get();
    }
}
