<?php 

namespace App\Repositories;

interface CardRepositoryInterface {

    /**
     * Methods for getting image paths
     *
     * These methods accept attribute name as written in
     * the db (example: $rarity = 'RARE')
     *
     * They return associative array where key is
     * id of the card in the database and 
     * value is path to the card image
     */
    
    /**
     * @param  string
     * @return array
     */
    public function getImagesByRarity($rarity);

    /**
     * @param  string
     * @return array
     */
    public function getImagesByMechanic($mechanic);

    /**
     * @param  string
     * @return array
     */
    public function getImagesBySet($set);

    /**
     * @param  string
     * @return array
     */
    public function getImagesByType($type);



    /**
     * getTooltipById($id)
     *
     * Parameter $id is id of the card in the db
     * 
     * It returns data neccessary for showing the
     * tooltip on card (on hover usually)
     */
    
    /**
     * @param  int
     * @return EloquentCollection
     */
    public function getTooltipById($id);

}