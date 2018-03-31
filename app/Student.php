<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function clas(){
        return $this->belongsTo('App\Clas');
    }
}
