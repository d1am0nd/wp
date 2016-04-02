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
}
