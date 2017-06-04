<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CardRepositoryInterface;
use App\Repositories\CardAttributeRepositoryInterface;

class CardsController2 extends Controller
{
    public function __construct(CardRepositoryInterface $cards, CardAttributeRepositoryInterface $attributes)
    {
        $this->cards = $cards;
        $this->attributes = $attributes;
    }

    public function getCardsJson()
    {
        return response()->json($this->cards->getCardsWithInfo()->toJson());
    }

    public function getCardAttributesJson()
    {
        return response()->json(collect([
            'rarities' => $this->attributes->getRarities(),
            'mechanics' => $this->attributes->getMechanics(),
            'playReqs' => $this->attributes->getPlayReqs(),
            'sets' => $this->attributes->getSets(),
            'types' => $this->attributes->getTypes(),
            'classes' => $this->attributes->getClasses()
        ])->toJson());
    }
}
