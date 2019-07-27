<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperHasStudent extends Model
{
    public function super()
    {
    	return $this->belongsTo('App\User', 'super_id', 'id');
    }

    public function student()
    {
    	return $this->belongsTo('App\Arrival', 'student_id', 'id');
    }

}
