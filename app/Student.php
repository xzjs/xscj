<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function clas(){
        return $this->belongsTo('App\Clas');
    }

    public function grades(){
        return $this->hasMany('App\Grade');
    }

    //转换为json的时候隐藏密码
    protected $hidden = ['pwd'];
}
