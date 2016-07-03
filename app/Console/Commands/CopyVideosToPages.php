<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon;
use App\Page;
use App\Vote;
use App\Video;
use App\Comment;
use App\PageType;

class CopyVideosToPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:videosToPages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copies all "videos" database records to "pages". Sets correct page_type_id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $videos = Video::with('comments', 'votes')->with('tags')->get();
        $types = PageType::lists('id', 'name');

        // Copy videos
        DB::transaction(function() use($videos, $types) {
            foreach($videos as $video) {
                $pageInDb = Page::where('slug', $video->slug)->first();

                if(isset($pageInDb))
                    continue;

                $newPage = new Page;
                $newPage->title = $video->title;
                $newPage->description = $video->description;
                $newPage->url = $video->url;
                $newPage->thumbnail_path = $video->thumbnail_path;
                $newPage->user_id = $video->user_id;
                $newPage->vote_sum = $video->vote_sum;
                $newPage->created_at = $video->created_at_timestamp;
                $newPage->updated_at = $video->updated_at_timestamp;
                $newPage->comment_count = $video->comment_count;
                $newPage->slug = $video->slug;
                $newPage->page_type_id = ($video->isVideo ? $types['Video'] : $types['Channel']);
                $newPage->save();

                foreach($video->comments as $comment) {
                    $comment = new Comment;
                    $comment->commentable_id = $newPage->id;
                    $comment->commentable_type = 'App\Page';
                    $comment->save();
                }            

                foreach($video->votes as $currVote) {
                    $vote = new Vote;
                    $vote->voteable_id = $newPage->id;
                    $vote->voteable_type = 'App\Page';
                    $vote->user_id = $currVote->user_id;
                    $vote->vote = $currVote->vote;
                    $vote->save();
                }

                foreach($video->tags as $tag) {
                    $taggable = [
                        'taggable_id' => $newPage->id,
                        'taggable_type' => 'App\Page',
                        'tag_id' => $tag->id
                    ];

                    DB::table('taggables')->insert($taggable);
                }
            }
        });

        $this->info("done");
    }
}
