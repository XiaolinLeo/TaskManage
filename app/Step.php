<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Step extends Model
{
    protected $fillable =['name','completion','task_id'];


    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
