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

    function addmember(Request $request){
        // $data['user'] = User::where('level','Member')->whereDoesntHave('member')->get();
        $data['user'] = User::where('level','Member')->get();
        $data['task'] = Task::find($request->id);
        return view('member.add-member',$data);
        // $data['task'] = Report::with('tasks')->whereHas('tasks',function($query){
        //     $query->whereDoesntHave('members')->get();
        // });
    }

    function createmember(Request $request){
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
