<?php

namespace App\Http\Controllers;

use App\Models\Detail_Report;
use App\Models\Event;
use App\Models\Report;
use App\Models\Task;
use App\Models\User;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        return view('login');
    }

    function auth(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validate)) {
            $user = Auth::user();

            if ($user->level === 'Admin') {
                return redirect('/home');
            } elseif ($user->level === 'Member') {
                return redirect('/member/home');
            }
        }

        return redirect()->back()->with('pesan', 'Email atau password salah');

    }

    function home()
    {
        $data['userCount'] = User::count();
        $data ['eventCount'] = Event::count();
        $data['reportCount'] = Report::where('percentage', 100)->count();
        $data['taskCount'] = Task::where('percentage', 100)->count();
        $data['detailCount'] = Detail_Report::where('percentage', 100)->count();
        return view('admin.home', $data);
    }

    function profile()
    {
        return view('admin.profile');
    }
    function profupdate(Request $request)
    {
        $data['user'] = User::find($request->id);
        return view('admin.user-edit',$data);
    }

    function createuser()
    {
        return view('admin.add-user');
    }

    function adduser(Request $request)
    {
        $user = $request->validate(
            [
                'name' => ['required'],
                'username' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'nohp' => ['required'],
                'address' => ['required'],
                'password' => ['required'],
            ],
            [
                'email.unique' => 'Email already exists, please use a different one.',
            ],
        );
        $request['level'] = 2;
        // $request['password'] = bcrypt($request->password);

        if ($user) {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'address' => $request->address,
                'level' => 2,
                'password' => bcrypt($request->password),
            ]);
            return redirect('/user')->with('Sukses', 'User successfully added');
        } else {
            return redirect('/adduser');
        }
    }

    function showuser()
    {
        $users = User::paginate(10);
        return view('admin/user', compact('users'));
    }

    function update(Request $request)
    {
        $data['user'] = User::find($request->id);
        return view('admin/user-edit', $data);
    }

    function edit(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'min:20',
            'email' => 'required|email',
            'nohp' => 'required',
            'numeric',
            'address' => 'required',
            'foto' => '',
        ]);
        $request['level'] = 2;
        $request['password'] = bcrypt($request->password);

        if ($validasi) {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'address' => $request->address,
                'password' => bcrypt($request->password),
            ]);
            if (Auth::user()->level === 'Admin') {
                return redirect('/user')->with('pesan', 'User successfully changed');
            } elseif (Auth::user()->level === 'Member') {
                return redirect('/member/profile')->with('edit', 'Profile successfully updated');
            }
        } else {
            return back();
        }
    }

    function delete(Request $request)
    {
        User::find($request->id);
        User::where('id', $request->id)->delete();

        return redirect('/user')->with('Delete', 'User successfuly deleted');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
