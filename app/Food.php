<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //relationship with user (M+M)
    public function users ()
    {
        return $this->belongsToMany('App\User')->withPivot('intake_amount', 'energy', 'protein', 'fluid', 'potassium', 'phosphate', 'sodium')->withTimestamps();
    }

}
