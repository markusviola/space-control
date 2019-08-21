<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Form;

class Schedule extends Model
{
    protected $unguarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
