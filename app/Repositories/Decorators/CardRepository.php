<?php

namespace App\Repositories;

use Cache;
use App\Repositories\CardRepository as CardRepositoryOriginal;

class CardRepository extends CardRepositoryOriginal
{
    public function __construct(Cache $cache)
    {
        parent::__construct();

        $this->cache = $cache;
    }

    public function getCardsWithInfo()
    {
        if ($this->cache->has('cards_with_info')) {
            return $this->cache->get('cards_with_info');
        }
        $result = $this->parent->getCardsWithInfo();
        $this->cache->put('cards_with_info', $result, 300);
        return $result;
    }
}
