<?php

namespace App;

use App\Traits\VoteableTrait;
use App\Traits\TaggableTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use TaggableTrait, VoteableTrait;
    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
