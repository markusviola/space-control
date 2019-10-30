<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Space extends Model
{
    protected $guarded = [];

    public function bulkSpaces()
    {
        return $this->hasMany(BulkSpace::class);
    }
}
