<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    function showtask()
    {
        $data['task'] = Task::all();
        $data['events'] = Event::all();
        $tasks = Task::whereNull('task_idtasks')->with('parentTask')->get();

        return view('tasks.tasks', $data, compact('tasks'));
    }

    function selectEvents(Request $request){
        $eventId = $request->input('event_id');

        // Query semua event untuk dropdown
        $events = Event::all();

        // Filter task berdasarkan event jika event_id diberikan
        $tasks = Task::with('events')
            ->when($eventId, function ($query) use ($eventId) {
                $query->where('events_id', $eventId);
            })
            ->get();

        return view('tasks.tasks', compact('tasks', 'events'));
    }

    // function search(Request $request){
    //       // Ambil parameter pencarian dari input
    // $search = $request->input('search');

    // // Query tasks sesuai dengan pencarian nama event
    // $tasks = Task::with('events')
    //     ->where('name', 'like', '%' . $search . '%') // Filter berdasarkan nama task
    //     ->orWhereHas('events', function ($query) use ($search) {
    //         $query->where('name', 'like', '%' . $search . '%'); // Filter berdasarkan nama event
    //     })
    //     ->get();

    // return view('tasks.tasks', compact('tasks', 'search'));
    // }
    //   function completeTask($taskId){
    //         $task = Task::findorFail($taskId);
    //         $task->update(['percentage' => 100]);

    //         $event = $task->event;
    //         $event->calculated_percentage = $this->calculateEventPercentage($event);
    //         $event->update(['percentage' => $event->calculated_percentage]);
    //         return redirect()->back()->with('success', 'Task marked as complete');
    //     }

    //     private function calculateEventPercentage($event){

    //         $totalTasks = 0;
    //         $completedTasks = 0;

    //         foreach ($event->tasks as $task) {
    //             $totalTasks++;
    //             if ($task->percentage == 100) {
    //                 $completedTasks++;
    //             }

    //             foreach ($task->subTasks as $subtask ) {
    //                 $totalTasks++;
    //                 if ($subtask->percentage == 100) {
    //                     $completedTasks++;
    //                 }

    //                 foreach ($task->subSubTasks as $subsubtask) {
    //                     $totalTasks++;
    //                     if ($subsubtask->percentage == 100) {
    //                         $completedTasks++;
    //                     }
    //                 }
    //             }
    //         }
    //         return ($totalTasks > 0) ? ($completedTasks / $totalTasks) * 100 : 0;
    //     }

    function addtask(Request $request)
    {
        $data['event'] = Event::find($request->id);
        return view('tasks.add-task', $data);
    }

    function createtask(Request $request)
    {
        $task = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'events_id' => ['required'],
            // "task_idtasks" => ["required"]
        ]);
        if ($task) {
            Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'events_id' => $request->events_id,
                // "task_idtasks" => $request->task_idtasks,
            ]);
            if (Auth::user()->level === 'Admin') {
                return redirect('/task')->with('pesan', 'Task successfully added');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/task')->with('pesan', 'Task successfully added');
            }
            return redirect()->back();
        }
    }

    function edittask(Request $request)
    {
        $data['task'] = Task::find($request->id);
        return view('tasks.edit-task', $data);
    }

    function updatetask(Request $request)
    {
        Task::find($request->id);
        Task::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if (Auth::user()->level === 'Admin') {
            return redirect('/task')->with('update', 'Task successfully updated');
        } elseif (Auth::user()->level === 'Member') {
            return redirect('/member/task')->with('update', 'Task successfully updated');
        }
        return redirect()->back();
    }

    function deletetask(Request $request)
    {
        Task::find($request->id);
        Task::where('id', $request->id)->delete();

        return redirect('/task');
    }

    function showsubtask(Request $request)
    {
        $tasks = Task::where('task_idtasks', $request->id)->get();
        $task = Task::find($request->id);
        return view('admin.sub-task', compact('tasks', 'task'));
    }

    function addsubtask(Request $request)
    {
        $data['task'] = Task::where('id', $request->id)->first();
        return view('admin.add-sub-task', $data);
    }

    function createsubtask(Request $request)
    {
        $create = $request->name;
        $validate = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'events_id' => ['required'],
            'task_idtasks' => ['required'],
        ]);
        if ($validate) {
            foreach ($create as $key => $name) {
                if ($name != null) {
                    Task::create([
                        'name' => $name,
                        'description' => $request->description[$key],
                        'events_id' => $request->events_id,
                        'task_idtasks' => $request->task_idtasks,
                    ]);
                }
            }
            if (Auth::user()->level === 'Admin') {
                return redirect('/subtask/' . $request->id)->with('sukses', 'Berhasil');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/subtask/' . $request->id)->with('sukses', 'Berhasil');
            }
        }
        return redirect()->back()->with('Error', 'Gagal');
    }

    function editsubtask(Request $request)
    {
        $data['task'] = Task::where('id', $request->id)->first();
        return view('admin.edit-sub-task', $data);
    }

    function updatesubtask(Request $request)
    {
        Task::find($request->id);
        Task::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if (Auth::user()->level === 'Admin') {
            return redirect('/task/')->with('sukses', 'Berhasil');
        } elseif (Auth::user()->level === 'Member') {
            return redirect('/member/task/')->with('sukses', 'Berhasil');
        }
        return redirect()->back()->with('Error', 'Gagal');
    }

    // function deletesubtask(Request $request){
    //     Task::find($request->id);
    //     Task::where('id', $request->id)->delete();
    //     return redirect('/subtask/'.$request->id)->with('delete', 'Berhasil Dihapus');
    // }

    function showsubSubtask(Request $request)
    {
        $tasks = Task::where('task_idtasks', $request->id)->get();
        $task = Task::find($request->id);

        return view('admin.subsub-task', compact('tasks', 'task'));
    }

    function addsubSubtasks(Request $request)
    {
        $data['task'] = Task::where('id', $request->id)->first();
        return view('admin.add-subsub-task', $data);
    }

    function addsubSubtask(Request $request)
    {
        $create = $request->name;
        $validate = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'events_id' => ['required'],
            'task_idtasks' => ['required'],
        ]);

        if ($validate) {
            foreach ($create as $key => $name) {
                if ($name != null) {
                    $task = Task::create([
                        'name' => $name,
                        'description' => $request->description[$key],
                        'events_id' => $request->events_id,
                        'task_idtasks' => $request->task_idtasks,
                    ]);
                }
            }
            if (Auth::user()->level === 'Admin') {
                return redirect('/subSubtask/' . $request->id)->with('sukses', 'Berhasil');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/subSubtask/' . $request->id)->with('sukses', 'Berhasil');
            }
        }
        return redirect()->back()->with('error', 'gagal');
    }

    function edit(Request $request)
    {
        $data['task'] = Task::find($request->id);
        return view('admin.edit-subsub-task', $data);
    }

    function update(Request $request)
    {
        Task::find($request->id);
        Task::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if (Auth::user()->level === 'Admin') {
            return redirect('/subSubtask/' . $request->id)->with('sukses', 'Berhasil');
        } elseif (Auth::user()->level === 'Member') {
            return redirect('/member/subSubtask/' . $request->id)->with('sukses', 'Berhasil');
        }
        return redirect()->back()->with('error', 'gagal');
    }

    function delete(Request $request)
    {
        Task::find($request->id);
        Task::where('id', $request->id)->delete();

        return redirect('/task')->with('sukses', 'Berhasil');
    }
}
