<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
  xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  <url>
    <loc>http://www.wizard-poker.com/</loc>
    <image:image>
       <image:loc>http://www.wizard-poker.com/backgrounds/demon-hunter-bg.jpg</image:loc>
       <image:caption>Quick Hearthstone Card Search | Wizard Poker</image:caption>
    </image:image>
  </url>
  @foreach ($cards as $card)
  <url>
    <loc>http://www.wizard-poker.com/card/{{ $card->slug }}</loc>
    <image:image>
       <image:loc>{{ $card->image_path }}</image:loc>
       <image:caption>{{ $card->name }} | Wizard Poker</image:caption>
    </image:image>
  </url>
  @endforeach
</urlset>
