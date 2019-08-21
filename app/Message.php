<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    protected $unguarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
