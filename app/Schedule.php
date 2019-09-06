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

    public function getStartDate()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time);
        return $date->format('Y年 m月 d日');
    }

    public function getEndDate()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->end_time);
        return $date->format('Y年 m月 d日');
    }

    public function getStartTime()
    {
        $time = \DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time);
        return $time->format('H:i');
    }

    public function getEndTime()
    {
        $time = \DateTime::createFromFormat('Y-m-d H:i:s', $this->end_time);
        return $time->format('H:i');
    }

    public function getStartTimeAttribute($attribute){

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        $time = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        return [
            'date' => $date->format('Y年 m月 d日'),
            'time' => $time->format('H:i'),
        ];
    }

    public function getEndTimeAttribute($attribute){

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        $time = \DateTime::createFromFormat('Y-m-d H:i:s', $attribute);
        return [
            'date' => $date->format('Y年 m月 d日'),
            'time' => $time->format('H:i'),
        ];
    }

}
