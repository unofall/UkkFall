<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    function events(){
        return $this->belongsTo(Event::class,'events_id');
    }
    function members(){
        return $this->belongsTo(Member::class, 'task_id'.'user_id');
    }

    function parentTask(){
        return $this->belongsTo(Task::class,'task_idtasks');
    }

    function subTasks(){
        return $this->hasMany(Task::class,'task_idtasks');
    }

    function subSubTasks(){
        return $this->hasMany(Task::class,'task_idtasks');
    }

    function reports(){
        return $this->hasMany(Report::class, 'task_idtasks');
    }


}
