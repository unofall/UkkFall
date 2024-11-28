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
       
            Member::create([
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
            ]);


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
        $data['task'] = Task::where('id', $request->id)->first();
        $data['user'] = User::where('level', 'Member')->get();

        return view('member.edit-member', $data);
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
