<?php

namespace App\Traits;

trait TaggableTrait
{
    public function tags()
    {
        return $this->morphToMany(\App\Tag::class, 'taggable');
    }

    public function scopeWhereHasTags($query, $tagsArray)
    {
        $query->with('tags');
        if(!isset($tagsArray))
            return $query;
        return $query->whereHas('tags', function($query) use ($tagsArray){
            foreach($tagsArray as $tag){
                $query->where('name', $tag);
            }
        });
    }
}
