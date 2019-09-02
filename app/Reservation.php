<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function discovery()
    {
        return $this->belongsTo(Discovery::class);
    }
}
