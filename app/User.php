<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','userId', 'password', 'img', 'award', 'department', 'flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function arrival()
    {
        return $this->hasOne('App\Arrival');
    }

    public function news()
    {
        return $this->hasMany('App\Info');
    }

    public function logbook()
    {
        return $this->hasOne('App\Logbook');
    }

    public function placement()
    {
        $this->hasMany('App\Location');
    }

    public function result()
    {
        return $this->hasOne('App\Result');
    }

    public function super_has_student()
    {
        return $this->hasMany('App\SuperHasStudent', 'super_id', 'id');
    }


}
