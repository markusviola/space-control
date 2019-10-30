<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    protected $guarded = [];

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
