<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
