<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PageTypeRepositoryInterface;

class PagesController extends Controller
{

    public function __construct(PageTypeRepositoryInterface $pageTypes)
    {
        $this->pageTypes = $pageTypes;
    }

    public function getPageTypes()
    {
        return $this->pageTypes
            ->getTypes()
            ->toJson();
    }
}
