<?php

namespace App;

use App\Traits\VoteableTrait;
use App\Traits\TaggableTrait;
use App\Traits\CommentableTrait;
use App\Traits\NiceTimestampAccTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use TaggableTrait, VoteableTrait, CommentableTrait, NiceTimestampAccTrait;
    
    protected $fillable = ['title', 'description', 'url', 'page_type_id', 'slug', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }
}
