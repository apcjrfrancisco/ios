<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserAll()
    {
        $users = User::all();
        return view('backend.user.user_all', compact('users'));
    }

    public function UserAdd()
    {
        return view('backend.user.user_add');
    }

    public function UserStore(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_as' => $request->role_as,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'User Created',  
            'alert-type' => 'success'
        );
        return redirect()->route('user.all')->with($notification);
    }

    public function UserDelete($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User Deleted',  
            'alert-type' => 'info'
        );
        return redirect()->route('user.all')->with($notification);
    }
}
