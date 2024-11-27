<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    function show()
    {
        if (Auth::user()->id == 1) {
            $data['report'] = Report::all();
        } else {
            $data['report'] = Report::all();
        }
        return view('report.reports', $data);
    }

    function add(Request $request)
    {
        $data['task'] = Task::where('id', $request->id)->first();
        return view('report.add-report', $data);
    }

    function create(Request $request)
    {
        $create = $request->name;
        $validate = $request->validate([
            'name' => ['required'],
            'duetime' => ['required', 'date'],
            'task_idtasks' => ['required'],
            'percentage' => '',
        ]);

        if ($validate) {
            foreach ($create as $key => $name) {
                if ($name != null) {
                    $report = Report::create([
                        'name' => $name,
                        'duetime' => $request->duetime,
                        'task_idtasks' => $request->task_idtasks,
                        'percentage' => 0,
                    ]);
                    if ($report) {
                        $report->update(['percentage' => 100]);
                    }
                }
            }
            $task = Task::findorFail($request->task_idtasks);
            $task->update(['percentage' => 100]);

            if (Auth::user()->level === 'Admin') {
                return redirect('/report')->with('success', 'Report created successfully');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/report')->with('success', 'Report created successfully');
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    function edit(Request $request){
        // $data['task'] = Task::where('id', $request->id)->first();
        $data['report'] =Report::find($request->id);
        $data['task'] =Task::find($request->id);
        return view('report.edit-report',$data);
    }

    function update(Request $request){
        $validate = $request->validate([
            'name' => ['required'],
            'duetime' => ['required','date'],
            'task_idtasks' => ['required'],
            // 'percentage' => '',
        ]);

        if ($validate) {
                    Report::where('id', $request->id)->update([
                        'name' => $request->name,
                        'duetime' => $request->duetime,
                        'task_idtasks' => $request->task_idtasks,
                        // 'percentage' => '',
                    ]);
                    if (Auth::user()->level === 'Admin') {
                        return redirect('/report')->with('success', 'Report successfully updated');
                    } elseif (Auth::user()->level === 'Member') {
                        return redirect('/member/report')->with('success', 'Report created successfully');
                    }
                    return redirect()->back();

            }
        }

    function delete(Request $request){
        Report::find($request->id);
        Report::where('id',$request->id)->delete();

        return redirect('/report')->with('delete', 'report successfully deleted ');
    }
    // function completeTask($taskId){
    //     $task = Task::findorFail($taskId);
    //     $task->update(['percentage' => 100]);
    //     return redirect()->back()->with('success', 'Task marked as complete');
    // }
}
