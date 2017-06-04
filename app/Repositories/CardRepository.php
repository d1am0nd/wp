<?php

namespace App\Repositories;

use App\Models\Cards\Card;

class CardRepository implements CardRepositoryInterface
{
    public function getImagesByRarity($rarity, $max = 20)
    {
        return $this->getImagesByAtt($rarity, 'cardRarity');
    }

    public function getImagesByMechanic($mechanic)
    {
        return $this->getImagesByAtt($mechanic, 'cardMechanic');
    }

    public function getImagesBySet($set)
    {
        return $this->getImagesByAtt($set, 'cardSet');
    }

    public function getImagesByType($type)
    {
        return $this->getImagesByAtt($type, 'cardType');
    }

    public function getTooltipById($id)
    {
        return Card::with('cardRarity', 'cardMechanics', 'cardSet', 'cardType')->findOrFail($id);
    }

    public function getCardsWithInfo()
    {
        return Card::leftJoin('classes', 'cards.class_id', '=', 'classes.id')
        /**
         * Each card must have these.
         * If it doesn't, the cards entry must be corrupted.
         */
        ->join('card_rarities', 'cards.card_rarity_id', '=', 'card_rarities.id')
        ->join('card_sets', 'cards.card_set_id', '=', 'card_sets.id')
        ->join('card_types', 'cards.card_type_id', '=', 'card_types.id')
        ->join('card_texts', 'cards.id', '=', 'card_texts.card_id')
        ->join('card_languages', function($q){
            $q->on('card_texts.card_language_id', '=', 'card_languages.id')
                ->where('card_languages.lang_id', '=', 'enUS');
        })
        ->select([
            'cards.id',
            'cards.card_id',
            'cards.image_path',
            'cards.cost',
            'cards.hp',
            'cards.atk',
            'card_rarities.name as rarity',
            'card_sets.name as set',
            'card_sets.is_standard as isStd',
            'card_types.name as type',
            'card_texts.name as name',
            'card_texts.text as text',
            'classes.name as class',
        ])
        ->with(['cardMechanics' => function($q){
            $q->select('id', 'name');
        }])
        // Hero portrait is not a card.
        ->where('card_types.name', '!=', 'HERO')
        ->orderBy('cards.cost', 'ASC')
        ->get();
    }

    private function getImagesByAtt($needle, $attName)
    {
        if($needle == 'all')
            return Card::select('id', 'image_path')->lists('image_path', 'id');

        return Card::select('id', 'image_path')
            ->whereHas($attName, function ($q) use($needle) {
                $q->where('name', $needle);
            })->lists('image_path', 'id');
    }
}
