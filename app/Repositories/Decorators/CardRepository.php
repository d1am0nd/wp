<?php

namespace App\Repositories\Decorators;

use Cache;
use App\Repositories\CardRepository as CardRepositoryOriginal;

class CardRepository extends CardRepositoryOriginal
{
    public function getCardsWithInfo()
    {
        if (Cache::has('cards_with_info')) {
            return Cache::get('cards_with_info');
        }
        $result = parent::getCardsWithInfo();
        Cache::put('cards_with_info', $result, 300);
        return $result;
    }
}
