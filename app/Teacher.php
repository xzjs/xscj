<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //转换为json的时候隐藏密码
    protected $hidden = ['pwd'];
}
