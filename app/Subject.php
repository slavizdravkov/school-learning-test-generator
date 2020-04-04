<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = array('name');

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
