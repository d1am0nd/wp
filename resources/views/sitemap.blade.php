<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
  xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  <url> 
    <loc>http://www.wizard-poker.com/pages</loc>
    @foreach($pages as $page)
    <image:image>
       <image:loc>http://www.wizard-poker.com{{$page->thumbnail_path}}</image:loc>
       <image:caption>{{$page->title}}</image:caption>
    </image:image>
    @endforeach
  </url>
  <url> 
    <loc>http://www.wizard-poker.com/videos</loc>
    @foreach($videos as $video)
    <image:image>
       <image:loc>http://www.wizard-poker.com{{$video->thumbnail_path}}</image:loc>
       <image:caption>{{$video->title}}</image:caption>
    </image:image>
    @endforeach
  </url>
</urlset>