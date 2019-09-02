<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discovery extends Model
{
    protected $guarded = [];

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
