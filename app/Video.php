<?php

namespace App;

use Carbon\Carbon;
use App\Traits\VoteableTrait;
use App\Traits\TaggableTrait;
use App\Traits\CommentableTrait;
use App\Traits\NiceTimestampAccTrait;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use TaggableTrait, VoteableTrait, CommentableTrait, NiceTimestampAccTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPublishedAtAttribute($attribute)
    {   
        if(isset($attribute))
            return Carbon::parse($attribute)->toFormattedDateString();
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
