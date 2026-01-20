<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name',
        'name_en',
    ];

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
}