<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = array('number', 'name');

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
