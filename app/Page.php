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
    
    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function pageType()
    {
        return $this->belongsTo('App\PageType');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
