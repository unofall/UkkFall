<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
