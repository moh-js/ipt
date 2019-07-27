<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function assigned()
    {
    	return $this->hasOne('App\SuperHasStudent', 'student_id', 'id');
    }
}
