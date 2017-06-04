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
        foreach($tagsArray as $tag){
            $query->whereHas('tags', function($query) use ($tag){
                $query->where('name', $tag);
            });
        }
    }

    /**
     * Returns queried item filtered by tags parameter. 
     * @param  string $tag    Tag name string
     * @param  array $select Items to select from tags
     * @return query
     */
    public function scopeWhereHasTag($query, $tag, $select = 'name')
    {
        if(isset($select)){
            $query->with(['tags' => function($q) use($select){
                $q->select('id', $select);
            }]);
        }else{
            $query->with('tags');
        }

        if(!isset($tag))
            return $query;

        $query->whereHas('tags', function($q) use ($tag){
            $q->where('name', $tag);
        });
    }
}
