<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Type;
use App\Schedule;
use App\BulkSpace;

class Form extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function bulkSpaces()
    {
        return $this->hasMany(BulkSpace::class);
    }

    public function getCreatedAtAttribute($attribute){

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        return $date->format('F d, Y');
    }
}
