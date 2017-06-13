<?php

namespace App\Console\Commands;

use DB;
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
    protected $description = 'Parses json card collection and inserts in db x<';

    // $key = json key, $value = database column name
    protected $cardAttributes = [
        'id' => 'card_id',
        'collectible' => 'collectable',
        'texture' => 'texture',
        'cost' => 'cost',
        'health' => 'hp',
        'attack' => 'atk',
    ];

    protected $cardHasMany = [
        'cardTexts',
        'cardMechanics',
        'cardPlayReqs',
    ];

    protected $cardHasOne = [
        'cardClass',
        'cardRarity',
        'cardSet',
        'cardType'
    ];

    private $json,
            $cards,
            $classes,
            $languages,
            $mechanics,
            $playReqs,
            $rarities,
            $sets,
            $types,
            $texts;

    private $allCards,
            $allClasses,
            $allLanguages,
            $allMechanics,
            $allPlayReqs,
            $allRarities,
            $allSets,
            $allTypes,
            $allTexts;

    private $mechanicPivot,
            $playReqPivot;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->json = json_decode(file_get_contents(storage_path() . '/cards.json'));
        $this->cards = [];
        $this->cardIds = [];
        $this->classes = [];
        $this->languages = [];
        $this->mechanics = [];
        $this->playReqs = [];
        $this->rarities = [];
        $this->sets = [];
        $this->types = [];
        $this->texts = [];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 14 is the number of all languages or something is wrong
        $languagesCount = CardLanguage::get()->count();
        $this->getLanguages();

        if($languagesCount != 14){
            DB::table('card_texts')->delete();
            DB::table('card_languages')->delete();
            $this->insertLanguages();
        }

        foreach($this->json as $card){
            array_push($this->cardIds, $card->id);
            $this->appendTypes($card);
            $this->appendSets($card);
            $this->appendRarities($card);
            $this->appendPlayReqs($card);
            $this->appendMechanics($card);
            $this->appendClasses($card);
        }
        /*
        $this->info(print_r($this->cards));
        $this->info(print_r($this->classes));
        $this->info(print_r($this->languages));
        $this->info(print_r($this->mechanics));
        $this->info(print_r($this->playReqs));
        $this->info(print_r($this->rarities));
        $this->info(print_r($this->sets));
        $this->info(print_r($this->types));
        */

        $this->insertTypes();
        $this->insertSets();
        $this->insertRarities();
        $this->insertPlayReqs();
        $this->insertMechanics();
        $this->insertClasses();

        $this->allClasses = CardClass::lists('id', 'name')->toArray();
        $this->allMechanics = CardMechanic::lists('id', 'name')->toArray();
        $this->allPlayReqs = CardPlayReq::lists('id', 'name')->toArray();
        $this->allRarities = CardRarity::lists('id', 'name')->toArray();
        $this->allSets = CardSet::lists('id', 'name')->toArray();
        $this->allTypes = CardType::lists('id', 'name')->toArray();
        $this->allLanguages = CardLanguage::lists('id', 'lang_id')->toArray();

        $this->info(print_r($this->allLanguages));

        $this->appendCards();
        $this->insertCards();

        $this->allCards = Card::lists('id', 'card_id')->toArray();

        DB::table('card_card_mechanic')->delete();
        DB::table('card_card_play_req')->delete();
        // Sync relations
        foreach($this->json as $card){
            $this->appendTexts($card);
            $this->insertMechanicPivots($card);
            $this->insertPlayReqPivots($card);
        }

        //$this->info(print_r($this->texts));
        CardText::truncate();
        foreach(array_chunk($this->texts, 500) as $key => $smallTexts){
            CardText::insert($smallTexts);
            $this->info('Chunk ' . $key . ' inserted');
        }

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

    private function appendCards()
    {
        foreach($this->json as $card){
            $tmp = [];
            foreach($this->cardAttributes as $key => $val){
                $item = null;
                if(isset($card->$key))
                    $item = $card->$key;
                if(isset($item))
                    $tmp[$val] = $item;
                else
                    $tmp[$val] = '';
            }
            // Append cclass_id
            if(isset($card->playerClass)){
                $className = $card->playerClass;
                $classId = $this->allClasses[$className];
                $tmp['class_id'] = $classId;
            }

            // Append card_type_id
            $typeName = $card->type;
            $typeId = $this->allTypes[$typeName];
            $tmp['card_type_id'] = $typeId;

            // Append card_set_id
            $setName = $card->set;
            $setId = $this->allSets[$setName];
            $tmp['card_set_id'] = $setId;

            // Append card_rarity_id
            $rarityName = $card->rarity;
            $rarityId = $this->allRarities[$rarityName];
            $tmp['card_rarity_id'] = $rarityId;

            // Append img url from http://wow.zamimg.com/images/hearthstone/cards/enus/original/{id}.png
            $tmp['image_path'] = 'http://media.services.zam.com/v1/media/byName/hs/cards/enus/pal/' . $card->id . '.png';

            array_push($this->cards, $tmp);
        }
    }

    private function appendTexts($card)
    {
        $cardId = $this->allCards[$card->id];
        if(!isset($cardId))
            return null;

        foreach($card->name as $lang => $name){
            if(isset($card->text))
                $text = $card->text->$lang;
            else
                $text = '';
            if (isset($card->flavor))
                $flavor = $card->flavor->$lang;
            else
                $flavor = '';

            $this->info($flavor);

            $langId = $this->allLanguages[$lang];

            if(isset($langId) && isset($name)){
                $tmpArray = [
                    'card_id'   => (int)$cardId,
                    'card_language_id' => (int)$langId,
                    'name'      => (string)$name,
                    'slug'      => str_slug((string)$name),
                    'text'      => (string)$text,
                    'flavor'    => (string)$flavor
                ];
                array_push($this->texts, $tmpArray);
                // CardText::create($tmpArray);
            }
        }
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

    private function insertLanguages()
    {
        $insertArray = $this->makeInsertArray($this->languages, 'lang_id');

        CardLanguage::insert($insertArray);

        $this->info(count($this->languages) . ' languages inserted.');
    }

    private function insertCards()
    {
        $dbItems = Card::whereIn('card_id', $this->cardIds)->lists('card_id')->toArray();
        $insertArray = $this->unsetCardsAlreadyInDb($dbItems, $this->cards);

        // Wierd error when trying to mass insert, so yeah
        foreach($insertArray as $card){
            Card::insert($card);
        }

        $this->info(count($insertArray) . ' cards inserted.');
    }

    private function insertMechanicPivots($card)
    {
        if(!isset($card->mechanics))
            return null;
        $tmpArray = [];
        foreach($card->mechanics as $mechanic){
            $cardId = $this->allCards[$card->id];
            $mechanicId = $this->allMechanics[$mechanic];

            $pivot = [
                'card_id' => $cardId,
                'card_mechanic_id' => $mechanicId
            ];

            array_push($tmpArray, $pivot);
        }

        DB::table('card_card_mechanic')->insert($tmpArray);
    }

    private function insertPlayReqPivots($card)
    {
        if(!isset($card->playRequirements))
            return null;
        $tmpArray = [];
        foreach($card->playRequirements as $pr => $val){
            $cardId = $this->allCards[$card->id];
            $playReqId = $this->allPlayReqs[$pr];

            $pivot = [
                'card_id' => $cardId,
                'card_play_req_id' => $playReqId,
                'value' => $val
            ];

            array_push($tmpArray, $pivot);
        }

        DB::table('card_card_play_req')->insert($tmpArray);
    }

    private function unsetCardsAlreadyInDb($dbItemIds, $cardsArray)
    {
        $tmpArray = [];
        foreach($cardsArray as $card){
            if(!in_array($card['card_id'], $dbItemIds))
                array_push($tmpArray, $card);
        }
        return $tmpArray;
    }

    private function makeInsertArray($itemsArray, $columnName, $mergeArray = [])
    {
        $insertArray = [];
        foreach($itemsArray as $item){
            $tmpArray = array_merge([$columnName => $item], $mergeArray);
            array_push($insertArray, $tmpArray);
        }
        return $insertArray;
    }

}
