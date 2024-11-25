<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    protected $guarded = [];

    function tasks(){
        return $this->belongsTo(Task::class, 'task_idtasks');
    }

   function subTasks(){
        return $this->belongsTo(Task::class,'task_idtasks');
   }

    function subSubTasks(){
        return $this->belongsTo(Task::class,'task_idtasks');
    }

    function detailReports(){
        return $this->hasMany(Detail_Report::class, 'reports_id');
    }
}
