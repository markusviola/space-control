<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    protected $guarded = [];

    public function toForm()
    {
        return $this->hasOne(Form::class, 'id', 'to');
    }

    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function getCreatedAtAttribute($attribute)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        return $date->format('H:i A | Y-m-d');
    }
}
