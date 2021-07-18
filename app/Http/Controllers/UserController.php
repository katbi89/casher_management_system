<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // validate inputs
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:filter',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:admin,casher'
        ]);

        // create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // back with success message
        return redirect('/add-user')->withSuccess('User Created Successfully');
    }

    public function read()
    {
        // read all users and pass to view page
        $users = User::all();

        return view('all_users', compact('users'));
    }

    public function readSingle()
    {
        // read single user information and pass to view page
        $user = User::find(Auth::id());
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        // validate inputs
        $unique = (Auth::user()->email == $request->email) ? "" : "unique:users";
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:filter|' . $unique,
        ]);

        $user = User::find(Auth::id());
        // check if user want to change password
        if (!is_null($request->password)) {
            // validate inputs
            $validated = $request->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);
            // Hash password before store in database
            $request->replace(['password' => Hash::make($request->password)]);
        } else {
            unset($request['password']);
        }
        // update user information
        $user->update($request->all());

        // if user change password redirect him to login page 
        if (isset($request->password)) {
            return redirect('/login')->withSuccess('Your Password Changed Successfully Please Login Again');
        }

        return back()->withSuccess('Updated Successfully');
    }

    public function delete(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'id' => 'required',
        ]);

        // delete user
        $delete = User::where('id', $request->id)->delete();

        // if deleted Successfully back with success message
        if ($delete) {
            return back()->withSuccess('User Deleted Successfully');
        } else {
            return back()->withError('User Not Found');
        }
    }
}
