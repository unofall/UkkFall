<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Report;
use App\Models\User;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(){
        return view('login');
    }

    function auth(Request $request){
        $validate =  $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if(Auth::attempt($validate)){
            $user = Auth::user();

            if ($user->level === 'Admin') {
                return redirect('/home');
            }

            elseif ($user->level === 'Member') {
                return redirect('/member/home');
            }
        }

        return redirect()->back()->with('pesan', 'Email atau password salah');
        // if (Auth::attempt($validate) == 'Admin') {
        //     return redirect('/home');
        // }elseif (Auth::attempt($validate) == 'Member') {
        //     return redirect('/member/home');
        // }

        }

    function homemember(){
        $userCount = User::count();
        $eventCount = Event::count();
        $reportCount = Report::count();
        return view('admin.home', compact('userCount','eventCount','reportCount'));
    }


    function home(){
        $userCount = User::count();
        $eventCount = Event::count();
        $reportCount = Report::count();
        return view('admin.home', compact('userCount','eventCount','reportCount'));
    }

    function profile(){;
        return view('admin.profile');
    }

    function createuser(){
        return view('admin.add-user');
    }



    function adduser(Request $request){
        $user = $request->validate([
            "name" => ['required'],
            "username" => ['required'],
            "email" => ['required', 'email', 'unique:users,email'],
            "nohp" => ['required'],
            "address" => ['required'],
            "password" => ['required']
        ],[
         'email.unique' => 'Email already exists, please use a different one.'
    ]);
        $request['level'] = 2;
        // $request['password'] = bcrypt($request->password);


        if ($user) {
            User::create([
                "name" => $request->name,
                "username" => $request->username,
                "email" => $request->email,
                "nohp" => $request->nohp,
                "address" => $request->address,
                "level" => 2,
                "password" => bcrypt($request->password)
            ]);
            return redirect('/user')->with('Sukses', 'User successfully added');
        }else {
            return redirect('/adduser');
        }
    }


    function showuser(){
        $users = User::paginate(10);
        return view('admin/user', compact('users'));
    }

    function update(Request $request){
        $data["user"] = User::find($request->id);
        return view('admin/user-edit', $data);
    }

    function edit(Request $request){
        $validasi = $request->validate([
            "name" => 'required',
            "username" => 'required','min:20',
            "email" => 'required|email',
            "nohp" => 'required','numeric',
            "address" => 'required',
            "foto" =>   '',
        ]);
        $request['level'] = 2;
        $request['password'] = bcrypt($request->password);

        if ($validasi) {
            User::where('id', $request->id)->update([
                "name" => $request->name,
                "username" => $request->username,
                "email" => $request->email,
                "nohp" => $request->nohp,
                "address" => $request->address,
                "password" => bcrypt($request->password)
            ]);
            return redirect('/user')->with('pesan', 'User successfully changed');
        }else {
            return back();
        }
    }

    function delete(Request $request){
        User::find($request->id);
        User::where('id', $request->id)->delete();

        return redirect('/user')->with('Delete', 'User successfuly deleted');
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
