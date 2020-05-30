<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    public function users ()
    {
        return $this->belongsToMany('App\User');
    }
}
