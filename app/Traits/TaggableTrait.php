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
        if(!isset($tagsArray))
            return $this;
        return $query->whereHas('tags', function($query) use ($tagsArray){
            foreach($tagsArray as $tag){
                $query->where('tags.name', $tag);
            }
        });
    }
}
