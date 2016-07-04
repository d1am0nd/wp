<?php 

namespace App\Repositories;

use App\PageType;

class PageTypeRepository implements PageTypeRepositoryInterface {

    private $pageType, $importantAttributes;

    public function __construct(PageType $pageType)
    {
        $this->pageType = $pageType;
        $this->importantAttributes = [
            'id',
            'name'
        ];
    }

    public function getTypes()
    {
        return $this->pageType->select($this->importantAttributes)->get();
    }

    public function getTypeByName($type)
    {
        return $this->pageType
            ->where('name', $type)
            ->select($this->importantAttributes)
            ->firstOrFail();
    }

}