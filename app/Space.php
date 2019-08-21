<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BulkSpace;

class Space extends Model
{
    protected $unguarded = [];

    public function bulkSpaces()
    {
        return $this->hasMany(BulkSpace::class);
    }
}
