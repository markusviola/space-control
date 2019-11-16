<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Form extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
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

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    public function triggerIsApproved()
    {
        $this->is_approved= true;
        return $this;
    }

    public function getCreatedAtAttribute($attribute){

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        return $date->format('Y年 m月 d日');
    }

    public function getBirthdayAttribute($attribute)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $attribute);
        return $date->format('Y年 m月 d日');
    }

}
