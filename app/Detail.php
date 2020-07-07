<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [];
    
    // protected $table='details';
    //

    //relationship with user (1+1)
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
