<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Report;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    function show(){
        $members = Member::paginate(10);
        return view('member.member',compact('members'));
    }

    function addmember($id) {
        // Retrieve users with 'Member' level
        $data['user'] = User::where('level', 'Member')->get();

        // Retrieve the task by ID
        $data['task'] = Task::find($id);

        // If the task doesn't exist, return an error or redirect
        if (!$data['task']) {
            return redirect()->back()->with('error', 'Task not found');
        }

        // Return the view with the user and task data
        return view('member.add-member', $data);
    }


    function createmember(Request $request) {
        // Validate the incoming request data
        $member = $request->validate([
            'user_id' => ['required'],
            'task_id' => ['required']
        ]);

        if ($member) {
            // Create a new member record
            Member::create([
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
            ]);

            // Retrieve the task to update its users_id
            $task = Task::find($request->task_id);

            if ($task) {
                // Get the current users_id or initialize as an empty array
                $users_id = $task->users_id ?? [];

                // Add the new user_id to the users_id array if not already there
                if (!in_array($request->user_id, $users_id)) {
                    $users_id[] = $request->user_id;
                }

                // Save the updated task with the new users_id
                $task->users_id = $users_id;
               
            }

            // Redirect to the 'showmember' page after successfully adding the member
            return redirect('/member/showmember');
        }
    }


    function delete(Request $request){
        Member::find($request->id);
        Member::where('id',$request->id)->delete();
        return redirect('/member/showmember');
    }

    function edit(Request $request){
        $data['member'] = Member::find($request->id);
        return view('');
    }

    function update(Request $request){
        Member::find($request->id);
        Member::where('id',$request->id)->update([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
        ]);
        return redirect('/member');

    }
}
