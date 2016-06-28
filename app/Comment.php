<?php

namespace App;

use App\Traits\VoteableTrait;
use App\Traits\NiceTimestampAccTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use VoteableTrait, SoftDeletes, NiceTimestampAccTrait;
    
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
