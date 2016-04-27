<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Video;
use App\Http\Requests;
use App\Repositories\CardRepositoryInterface;

class GeneralController extends Controller
{
    public function __construct(CardRepositoryInterface $cards)
    {
        $this->cards = $cards;
    }

    public function getHome(Request $request)
    {
        return view('home');
    }

    public function getTos()
    {
        return view('tos');
    }

    public function getSitemapXml()
    {
        $videos = Video::get();
        $pages = Page::get();
        $cards = $this->cards->getCardsWithInfo();
        $content = view('sitemap', compact('videos', 'pages', 'cards'))->render();
        return response($content)->header('Content-Type', 'application/xml');
    }

    public function getOrderByJson()
    {
        return config('misc.orderByJson');
    }
}
