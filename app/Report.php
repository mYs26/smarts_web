<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //relationship with user (1+M)
    public function users ()
    {
        return $this->belongsToMany('App\User');
    }
}
