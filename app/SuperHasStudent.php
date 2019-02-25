<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperHasStudent extends Model
{
    public function super()
    {
    	return $this->belongsTo('App\User', 'super_id', 'id');
    }

    public function student_arrival()
    {
    	return $this->belongsTo('App\Arrival', 'student_id', 'id');
    }

    public function students()
    {
    	return $this->belongsTo('App\User', 'student_id', 'id');
    }

}
