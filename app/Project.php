<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=[
        'name','thumbnail',
    ];

    public function user(){
        //一个项目属于一个用户
        //project->user
        return $this->belongsTo('App\User');
    }
}
