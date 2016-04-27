<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CardRepositoryInterface;
use App\Repositories\CardAttributeRepositoryInterface;

class CardsController extends Controller
{
    public function __construct(CardRepositoryInterface $cards, CardAttributeRepositoryInterface $attributes)
    {
        $this->cards = $cards;
        $this->attributes = $attributes;
    }

    public function index(Request $request)
    {
        $cards = $this->cards->getCardsWithInfo();
        $cardAttributes = collect(config('cardattributes'));
        return view('cards.index', compact('cardAttributes'));
    }

    public function getCardsByRarityJson()
    {
        return $this->cards->getImagesByRarity('RARE');
    }

    public function getCardsJson()
    {
        return $this->cards->getCardsWithInfo()->toJson();
    }

    public function getCardAttributesJson()
    {
        return json_encode(config('cardattributes'));
    }
}
