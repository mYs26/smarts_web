<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relationship with detail (1+1)
    public function detail()
    {
        return $this->hasOne('App\Detail');
    }

    //relationship with food (M+M)
    public function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('intake_amount', 'energy', 'protein', 'fluid', 'potassium', 'phosphate', 'sodium')->withTimestamps();
    }

    //relationsihp with report (1+M)
    public function reports()
    {
        return $this->hasmany('App\Report');
    }
}
