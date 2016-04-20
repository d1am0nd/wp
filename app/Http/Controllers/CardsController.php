<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CardRepositoryInterface;

class CardsController extends Controller
{
    public function __construct(CardRepositoryInterface $cards)
    {
        $this->cards = $cards;
    }

    public function getCardsByRarityJson(Request $request)
    {
        return $this->cards->getImagesByRarity('RARE');
    }
}
