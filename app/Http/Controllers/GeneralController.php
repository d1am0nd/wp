<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Video;
use App\Http\Requests;

class GeneralController extends Controller
{
    public function getSitemapXml()
    {
        $videos = Video::get();
        $pages = Page::get();
        $content = view('sitemap', compact('videos', 'pages'))->render();
        return response($content)->header('Content-Type', 'application/xml');
    }

    public function getHome()
    {
        return view('home');
    }
}
