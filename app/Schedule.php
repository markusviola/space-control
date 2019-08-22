<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Form;

class Schedule extends Model
{
    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
