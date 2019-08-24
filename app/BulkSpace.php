<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Space;
use App\Form;

class BulkSpace extends Model
{
    protected $guarded = [];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
