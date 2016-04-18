<?php

namespace App\Console\Commands;

use App\Models\Cards\Card;
use App\Models\Cards\CardSet;
use App\Models\Cards\CardText;
use App\Models\Cards\CardType;
use App\Models\Cards\CardClass;
use App\Models\Cards\CardRarity;
use App\Models\Cards\CardPlayReq;
use App\Models\Cards\CardMechanic;
use App\Models\Cards\CardLanguage;
use Illuminate\Console\Command;

class ParseCardsJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:cardsJson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    // $key = json key, $value = database column name
    protected $cardAttributes = [
        'id' => 'card_id',
        'collectible' => 'collectable',
        'texture' => 'texture',
        'cost' => 'cost',
        'health' => 'hp',
        'attack' => 'atk',
    ];

    private $json,
            $cards,
            $classes,
            $languages,
            $mechanics,
            $playReqs,
            $rarities,
            $sets,
            $types;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cards = [];
        $this->classes = [];
        $this->languages = [];
        $this->mechanics = [];
        $this->playReqs = [];
        $this->rarities = [];
        $this->sets = [];
        $this->types = [];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->json = json_decode(file_get_contents(storage_path() . '/cards.json'));
        $this->getLanguages();

        foreach($this->json as $card){
            $this->appendTypes($card);
            $this->appendSets($card);
            $this->appendRarities($card);
            $this->appendPlayReqs($card);
            $this->appendMechanics($card);
            $this->appendClasses($card);
            $this->appendCards($card);
        }
        $this->info(print_r($this->cards));
        $this->info(print_r($this->classes));
        $this->info(print_r($this->languages));
        $this->info(print_r($this->mechanics));
        $this->info(print_r($this->playReqs));
        $this->info(print_r($this->rarities));
        $this->info(print_r($this->sets));
        $this->info(print_r($this->types));

        $this->insertTypes();
        $this->insertSets();
        $this->insertRarities();
        $this->insertPlayReqs();
        $this->insertMechanics();
        $this->insertClasses();

        $this->info('Cards count: ' . count($this->json));
    }

    private function appendTypes($card)
    {
        $this->appendIfNew($card, 'type', 'types');
    }

    private function appendSets($card)
    {
        $this->appendIfNew($card, 'set', 'sets');
    }

    private function appendRarities($card)
    {
        $this->appendIfNew($card, 'rarity', 'rarities');
    }

    private function appendPlayReqs($card)
    {
        if(isset($card->playRequirements)){
            foreach($card->playRequirements as $pr => $val){
                if(!in_array($pr, $this->playReqs))
                    array_push($this->playReqs, $pr);
            }
        }
    }

    private function appendMechanics($card)
    {
        $this->appendIfNew($card, 'mechanics', 'mechanics');
    }

    private function appendClasses($card)
    {
        $this->appendIfNew($card, 'playerClass', 'classes');
    }

    public function getLanguages()
    {
        foreach($this->json[0]->name as $language => $name){
            array_push($this->languages, $language);
        }
    }

    private function appendCards($card)
    {
        $tmp = [];
        foreach($this->cardAttributes as $key => $val){
            $item = null;
            if(isset($card->$key))
                $item = $card->$key;
            if(isset($item))
                $tmp[$val] = $item;
        }
        if(isset($card->playRequirements))
            $tmp['playRequirements'] = $card->playRequirements;

        array_push($this->cards, $tmp);
    }

    private function appendIfNew($card, $itemName, $arrayName)
    {
        $item = null;
        if(isset($card->$itemName))
            $item = $card->$itemName;
        // If item is array, check for each value separately
        // otherwise only for the value
        if(is_array($item)){
            foreach($item as $val){
                if(!in_array($val, $this->$arrayName))
                    array_push($this->$arrayName, $val);
            }
        }elseif(isset($item) && !in_array($item, $this->$arrayName))
            array_push($this->$arrayName, $item);
    }

    // Inserts to db
    private function insertTypes()
    {
        $dbTypes = CardType::whereIn('name', $this->types)->lists('name')->toArray();
        $insertTypes = array_diff($this->types, $dbTypes);

        $insertArray = $this->makeInsertArray($insertTypes, 'name');

        CardType::insert($insertArray);

        $this->info(count($insertTypes) . ' types inserted.');
    }

    private function insertSets()
    {
        $dbItems = CardSet::whereIn('name', $this->sets)->lists('name')->toArray();
        $insertItems = array_diff($this->sets, $dbItems);

        $insertArray = $this->makeInsertArray($insertItems, 'name');

        CardSet::insert($insertArray);

        $this->info(count($insertItems) . ' sets inserted.');
    }

    private function insertRarities()
    {
        $dbItems = CardRarity::whereIn('name', $this->rarities)->lists('name')->toArray();
        $insertItems = array_diff($this->rarities, $dbItems);

        $insertArray = $this->makeInsertArray($insertItems, 'name');

        CardRarity::insert($insertArray);

        $this->info(count($insertItems) . ' rarities inserted.');
    }

    private function insertPlayReqs()
    {
        $dbItems = CardPlayReq::whereIn('name', $this->playReqs)->lists('name')->toArray();
        $insertItems = array_diff($this->playReqs, $dbItems);

        $insertArray = $this->makeInsertArray($insertItems, 'name');

        CardPlayReq::insert($insertArray);

        $this->info(count($insertItems) . ' play requirements inserted.');
    }

    private function insertMechanics()
    {
        $dbItems = CardMechanic::whereIn('name', $this->mechanics)->lists('name')->toArray();
        $insertItems = array_diff($this->mechanics, $dbItems);

        $insertArray = $this->makeInsertArray($insertItems, 'name');

        CardMechanic::insert($insertArray);

        $this->info(count($insertItems) . ' mechanics inserted.');
    }

    private function insertClasses()
    {
        $dbItems = CardClass::whereIn('name', $this->classes)->lists('name')->toArray();
        $insertItems = array_diff($this->classes, $dbItems);

        $insertArray = $this->makeInsertArray($insertItems, 'name');

        CardClass::insert($insertArray);

        $this->info(count($insertItems) . ' classes inserted.');
    }

    private function makeInsertArray($itemsArray, $columnName, $mergeArray = [])
    {
        $insertArray = [];
        foreach($itemsArray as $item){
            $tmpArray = array_merge([$columnName => $item], $mergeArray);
            array_push($insertArray, [
                    'name' => $item
                ]);
        }
        return $insertArray;
    }

    private function unsetByVal($array, $val)
    {
        if(($key = array_search($val, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }
}
