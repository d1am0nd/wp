<?php

namespace App\Repositories\Transformers;

use Cache;
use App\Repositories\CardRepository as CardRepositoryOriginal;

class CardRepository extends CardRepositoryOriginal
{
    public function getCardsWithInfo()
    {
        return parent::getCardsWithInfo()
            ->transform(function ($i, $k) {
                // Add external card urls
                $i->setAttribute('wikia_url', 'http://hearthstone.wikia.com/wiki/' . $i->name);
                $i->makeVisible(['wikia_url']);
                return $i;
            });
    }
}
