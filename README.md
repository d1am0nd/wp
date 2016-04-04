## www.wizard-poker.com

This is the source code to www.wizard-poker.com, website that I'm working on. It has plenty of interesting features and copy-pastable traits, but the main purpose is sharing links to good Hearthstone related content.

It is built on top of amazing framework Laravel 5.2 and equally amazing template Unify. Neither of these are included in the source code. Running command "php artisan composer install" installs the former.

## Cool features

* Automatad page (og tag) and youtube (youtube thumbnail) thumbnail updates
* Automated checking if the youtube link is channel or video. Links to iframe accordingly
* Automated Twitter updated within 30 minutes of some blog/reddit updates
* Copypastable Taggable, Voteable and Commentable traits

## Installation

Composer install Laravel, then edit .env or creat one based on .env.example then run migrations and setup Laravel scheduler. Should be it.

## About

The website was built mainly because I snatched the domain early after the "wizard poker" reddit post. And after having it sit around for over 6 months I decided to build a simple website on it. The main idea was to test out meteor.js, but halfway through I switched to Laravel 5.2.

## Features 

### Youtube Thumbnail updates

Ater a new youtube link is posted command 'video:updateThumbnail {id} {url}' (app/Console/Commands/UpdateVideoThumbnail.php) is ran, which then checks if the link is a video - in which case it gets the embedded url and thumbnail image. Otherwise, if it's a channel, it gets thumbnail from og:image tag. The image is then resized and saved to the server. The path to the image is updated in the database

### Page Thumbnail updates

After a new page is posted command 'page:updateThumbnail {id} {url}' (app/Console/Commands/UpdatePageThumbnail.php) is ran, which then gets the thumbnail image for the website from og:image tag.

### Twitter updates

Command 'twitter:updateRedditCustomWeekly' (app/Console/Commands/UpdateRedditCustomWeekly.php) checks reddit api for latest "Top 5 Scoring Cards of the Week from r/CustomHearthstone" post. If the post is different than the one in the database it posts on Twitter.

Command 'twitter:updateRedditArenaWeekly' (app/Console/Commands/UpdateArenaCustomWeekly.php) checks reddit api for latest "Top 5 Arena Streamers" post. If the post is different than the one in the database it posts on Twitter.

Command 'snapshot:updateUrl' (app/Console/Commands/UpdateMetaSnapshot.php) checks https://tempostorm.com/hearthstone/meta-snapshot for the latest Tempostorm Hearthstone Meta Snapshot. If it's different than the one in the database it posts on Twitter.

## Traits

Todo writeup. 