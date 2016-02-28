<?php

namespace App;

use Carbon\Carbon;
use App\Traits\VoteableTrait;
use App\Traits\TaggableTrait;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use TaggableTrait, VoteableTrait;

    protected $dates = ['published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPublishedAtAttribute($attribute)
    {
        return Carbon::parse($this->attributes['published_at'])->toFormattedDateString();
    }
}
