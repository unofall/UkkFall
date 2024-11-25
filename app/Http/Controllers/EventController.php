<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    function showevent()
    {
        $events = Event::all();
        // foreach ($events as $event) {
        //     if ($event) {
        //             $event->calculated_percentage = $this->calculateEventPercentage($event);
        //         }
        //     }
        return view('events.events', compact('events'));
    }

    // private function calculateEventPercentage($event){
    //     $totalTasks = 0;
    //     $completedTasks = 0;

    //     foreach ($event->tasks as $task) {
    //         $totalTasks++;
    //         if ($task->percentage == 100) {
    //             $completedTasks++;
    //         }

    //         foreach ($task->subTasks as $subtask ) {
    //             $totalTasks++;
    //             if ($subtask->percentage == 100) {
    //                 $completedTasks++;
    //             }

    //             foreach ($task->subSubTasks as $subsubtask) {
    //                 $totalTasks++;
    //                 if ($subsubtask->percentage == 100) {
    //                     $completedTasks++;
    //                 }
    //             }
    //         }
    //     }
    //     return round(($totalTasks > 0) ? ($completedTasks / $totalTasks) * 100 : 0);
    // }

    function addevent()
    {
        $data['user'] = User::where('level', 'member')->get();
        return view('events.add-event', $data);
    }

    function createevent(Request $request)
    {
        $event = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        if (Auth::user()->level === 'member') {
            $createdBy = Auth::user()->id;
        } else {
            $request->validate([
                'created_by' => ['required'],
            ]);
            $createdBy = $request->created_by;
        }


            Event::create([
                'name' => $request->name,
                'date' => $request->date,
                'description' => $request->description,
                'created_by' => $createdBy,
            ]);
            // return redirect('/event')->with('pesan', 'Event succesfully added');

            if (Auth::user()->level === 'Admin') {
                return redirect('/event')->with('pesan', 'Event successfully added');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/event')->with('pesan', 'Event successfully added');
            }

        return redirect()->back()->with('error', 'gagal');
    }

    function editevent(Request $request)
    {
        $data['user'] = User::where('level', 'member')->get();
        $data['event'] = Event::find($request->id);
        return view('events.edit-event', $data);
    }

    function updateevent(Request $request)
    {
        $event = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'created_by' => ['required'],
        ]);

        if ($event) {
            Event::where('id', $request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'created_by' => $request->created_by,
            ]);
            if (Auth::user()->level === 'Admin') {
                return redirect('/event')->with('edit', 'Event successfully updated');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/event')->with('edit', 'Event successfully updated');
            }
        }
        return redirect()->back()->with('error', 'gagal');

    }

    function deleteevent(Request $request)
    {
        Event::find($request->id);
        Event::where('id', $request->id)->delete();

         if (Auth::user()->level === 'Admin') {
                return redirect('/event')->with('Pesan', 'Event successfully added');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/event')->with('Pesan', 'Event successfully added');
            }
    }
}
