<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Form;

class Type extends Model
{
    protected $unguarded = [];

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
