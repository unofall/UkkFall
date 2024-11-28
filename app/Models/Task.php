<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    function events()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
    function members()
    {
        return $this->belongsTo(Member::class, 'task_id' . 'user_id');
    }

    function parentTask()
    {
        return $this->belongsTo(Task::class, 'task_idtasks');
    }

    function subTasks()
    {
        return $this->hasMany(Task::class, 'task_idtasks');
    }

    function subSubTasks()
    {
        return $this->hasMany(Task::class, 'task_idtasks');
    }

    function reports()
    {
        return $this->hasMany(Report::class, 'task_idtasks');
    }

    public function calculatePercentage()
    {
        // Ambil semua subtask yang terkait dengan task ini
        $subtasks = $this->subTasks()->get();

        // Jika tidak ada subtask, periksa apakah task memiliki laporan
        if ($subtasks->count() == 0) {
            // Jika task memiliki laporan dengan persentase 100, kembalikan 100
            if ($this->reports()->where('percentage', 100)->exists()) {
                return 100;
            }
            return 0;
        }

        // Hitung persentase untuk masing-masing subtask berdasarkan laporan dari sub-subtask
        $subtaskPercentages = $subtasks->map(function ($subtask) {
            return $subtask->calculateSubTaskPercentage();
        });

        // Hitung rata-rata persentase untuk semua subtask
        $averagePercentage = $subtaskPercentages->avg();

        // Update persentase pada task ini
        $this->update(['percentage' => $averagePercentage]);

        return $averagePercentage ?? 0;
    }

    // public function calculateSubTaskPercentage()
    // {
    //     // Ambil semua sub-subtask yang terkait dengan subtask ini
    //     $subSubtasks = $this->subSubTasks()->get();

    //     // Jika tidak ada sub-subtask, periksa apakah subtask memiliki laporan
    //     if ($subSubtasks->count() == 0) {
    //         // Jika subtask memiliki laporan dengan persentase 100, kembalikan 100
    //         if ($this->reports()->where('percentage', 100)->exists()) {
    //             return 100;
    //         }
    //         return 0;
    //     }

    //     // Hitung jumlah sub-subtask yang memiliki laporan dengan persentase 100%
    //     $completedSubSubtasks = $subSubtasks->filter(function ($subSubtask) {
    //         return $subSubtask->reports()->where('percentage', 100)->exists();
    //     });

    //     // Hitung persentase berdasarkan jumlah sub-subtask yang selesai dibandingkan total sub-subtask
    //     $percentage = ($completedSubSubtasks->count() / $subSubtasks->count()) * 100;

    //     // Update persentase pada subtask ini
    //     $this->update(['percentage' => $percentage]);

    //     return $percentage;
    // }

    public function calculateSubTaskPercentage()
    {
        // Ambil semua sub-subtask yang terkait dengan subtask ini
        $subSubtasks = $this->subSubTasks()->get();

        // Jika subtask memiliki laporan dengan persentase 100, anggap subtask selesai
        if ($this->reports()->where('percentage', 100)->exists()) {
            $this->update(['percentage' => 100]);
            return 100;
        }

        // Jika subtask memiliki sub-subtask, periksa apakah salah satu sub-subtask memiliki laporan 100
        if ($subSubtasks->isNotEmpty()) {
            $anyCompletedSubSubtask = $subSubtasks->filter(function ($subSubtask) {
                return $subSubtask->reports()->where('percentage', 100)->exists();
            });

            // Jika salah satu sub-subtask sudah selesai, anggap subtask selesai
            if ($anyCompletedSubSubtask->isNotEmpty()) {
                $this->update(['percentage' => 100]);
                return 100;
            }
        }

        // Jika tidak ada laporan pada subtask atau sub-subtask, set persentase ke 0
        $this->update(['percentage' => 0]);
        return 0;
    }
}
