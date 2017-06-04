<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $videos = Video::get();
        $pages = Page::get();
        $content = view('sitemap', compact('videos', 'pages'))->render();

        return response($content)->header('Content-Type', 'application/xml');
    }
}
