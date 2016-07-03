<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
  xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  <url> 
    <loc>http://www.wizard-poker.com/</loc>
    <image:image>
       <image:loc>http://www.wizard-poker.com/backgrounds/demon-hunter-bg.jpg</image:loc>
       <image:caption>Wizard-Poker Hearthstone Related Content</image:caption>
    </image:image>
  </url>
  <url> 
    <loc>http://www.wizard-poker.com/#/cards</loc>
    @foreach($cards as $card)
    <image:image>
       <image:loc>{{ $card->image_path }}</image:loc>
       <image:caption>{{ $card->name }}</image:caption>
    </image:image>
    @endforeach
  </url>
  @foreach($pages as $page)
  <url> 
    <loc>http://www.wizard-poker.com/#/pages/{{ $page->slug }}</loc>
    <image:image>
       <image:loc>http://www.wizard-poker.com{{ $page->thumbnail_path }}</image:loc>
       <image:caption>{{ $page->title }}</image:caption>
    </image:image>
  </url>
  @endforeach
  @foreach($videos as $video)
  <url> 
    <loc>http://www.wizard-poker.com/#/videos/{{ $video->slug }}</loc>
    <image:image>
       <image:loc>http://www.wizard-poker.com{{ $video->thumbnail_path }}</image:loc>
       <image:caption>{{ $video->title }}</image:caption>
    </image:image>
  </url>
  @endforeach
  <url> 
    <loc>http://www.wizard-poker.com/#/videos</loc>
    @foreach($videos as $video)
    @if($video->is_video == 1)
    <video:video>
      <video:player_loc allow_embed="yes">
        {{ $video->embed_url }}
      </video:player_loc>
      <video:thumbnail_loc>
        {{ $video->thumbnail_path }}
      </video:thumbnail_loc>
      <video:title>{{ $video->title }}</video:title>  
      <video:description>
        {{ $video->description }}
      </video:description>
    </video:video>
    @else
    <image:image>
       <image:loc>http://www.wizard-poker.com{{$video->thumbnail_path}}</image:loc>
       <image:caption>{{ $video->title }}</image:caption>
    </image:image>
    @endif
    @endforeach
  </url>
</urlset>