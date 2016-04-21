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