## www.wizard-poker.com

This is the source code to www.wizard-poker.com, website that I'm working on. It has plenty of interesting features and copy-pastable traits, but the main purpose is sharing links to good Hearthstone related content.

It is built on top of amazing framework Laravel 5.2 and equally amazing template Unify. Neither of these are included in the source code. Running command "php artisan composer install" installs the former.

## Cool features

* Automatad page and youtube link thumbnail updates
* Automated checking if the youtube link is channel or video. Links to iframe accordingly
* Automated Twitter updates within 30 minutes of some blog/reddit updates
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

app/Console/Commands/UpdateRedditCustomWeekly.php
Command 'twitter:updateRedditCustomWeekly' checks reddit api for latest "Top 5 Scoring Cards of the Week from r/CustomHearthstone" post. If the post is different than the one in the database it posts on Twitter.

app/Console/Commands/UpdateArenaCustomWeekly.php
Command 'twitter:updateRedditArenaWeekly' checks reddit api for latest "Top 5 Arena Streamers" post. If the post is different than the one in the database it posts on Twitter.

app/Console/Commands/UpdateMetaSnapshot.php
Command 'snapshot:updateUrl' checks https://tempostorm.com/hearthstone/meta-snapshot for the latest Tempostorm Hearthstone Meta Snapshot. If it's different than the one in the database it posts on Twitter.

## Traits

app/Traits

### TaggableTrait

Adds next methods to a model:
* tags() - Polymorphic relationship
* scopeWhereHasTags($tags) - Filters by parent models that have all of the $tags tags
* scopeWhereHasTag($tag) - Filters by parent models that have $tag tag

Expects:
* table 'tags':
** id int pk
** name string - tag name
** timestamps
* table taggables:
** tag_id int pk
** taggable_id int
** taggable_type string
* model Tags with polymorphic relationship defined

### VoteableTrait

Adds next methods to a model:
* votes() - Polymorphic relationship defined
* vote($vote) - Casts a numeric vote on the parent model. Accepts -1 or 1. Edit code for different possibilites
* updateVotesSum($amount) - Updates vote_sum on parent by $amount. For optimization when ordering by vote sum. 
* scopeOrderByVoteSum($query, $order = 'DESC') - Orders by vote_sum column. $order defines order. 
* scopeWithVotes($query) - Old unoptimized scope. Adds vote sum (as vote) by joining all votes and summing them in query. Adding vote_sum column to parent makes far more sense.
* scopeWithVotesOrder($query, $order = 'DESC') - Adds ->orderBy('votes', $order) to scopeWithVotes()
* scopeWithMyVote($query) - Left joins parent model with votes for currently logged in user's vote (as my_vote)
* scopeFilterOrderBy($query, $filterOrderBy) - My personal method for filtering by my parameters (hardcoded in trait) defined.

Expects:
* table 'votes':
** id int pk
** vote int
** user_id int fk on table users
** timestamps
* parent table (example 'pages') to have:
** vote_count int

### CommentableTrait

Adds next methods to a model:
* comments() - Polymorphic relationship defined
* comment($text, $parentId = null) - Adds comment with $text to parent model. If $parentId (user_id) is defined it attaches it to user with the id, otherwise to logged in user.
* updateCommentCount($amount) - Updates comment_count on parent. For optimization when ordering by vote count. 

Expects:
* table 'comments':
** id int pk
** text string
** user_id int fk on table users
** commentable_id int
**commentable_type string
** timestamps
* parent table (example 'pages') to have:
** comment_count int
