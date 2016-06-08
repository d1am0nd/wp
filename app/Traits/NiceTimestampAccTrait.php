<?php

namespace App\Traits;

use Carbon\Carbon;

trait NiceTimestampAccTrait
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getCreatedAtTimestampAttribute($value)
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestampAttribute($value)
    {
        return $this->attributes['updated_at'];
    }
}
