<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Form;

class Type extends Model
{
    protected $guarded = [];

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
