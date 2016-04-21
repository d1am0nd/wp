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
        $rarities = $this->attributes->getRarities();
        $filterRarity = $request->has('rarity') ? $request->input('rarity') : 'all';
        $cards = $this->cards->getImagesByRarity($filterRarity);
        return view('cards.index', compact('rarities', 'cards'));
    }

    public function getCardsByRarityJson()
    {
        return $this->cards->getImagesByRarity('RARE');
    }
}
