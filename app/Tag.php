<?php

namespace App;

use App\Vote;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'updated_at', 'created_at'];

    public function pages()
    {
        return $this>morphedByMany(Page::class, 'taggable');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
