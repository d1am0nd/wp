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
                $name = $this->encodeName($i->name);
                $i->setAttribute('wikia_url', 'http://hearthstone.wikia.com/wiki/' . $name);
                $i->setAttribute('gamepedia_url', 'http://hearthstone.gamepedia.com/' . $name);
                $i->setAttribute('hearthhead_url', 'http://www.hearthhead.com/cards/' . $i->slug);
                $i->makeVisible(['gamepedia_url', 'wikia_url']);
                return $i;
            });
    }

    private function encodeName($name)
    {
        return $name;
        return str_replace('%20', '_', rawurlencode($name));
    }
}
