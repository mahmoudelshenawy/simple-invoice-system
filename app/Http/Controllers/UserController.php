<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // File::delete(public_path('Attachments/Services/SER1001/mosaab.jpg'));
        $users = User::all();
        return view('users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::where('id', '!=', 1)->select('id', 'name')->get();
        return view('users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($request->super_admin == 'on') {
            $role = Role::find(1);
            $user->assignRole([$role->id]);
        }
        if ($request->role_id && count($request->role_id) > 0) {
            $user->assignRole($request->role_id);
        }

        session()->flash('Add');
        return back();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('id', '!=', 1)->select('id', 'name')->get();
        return view('users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($request->super_admin == 'on') {
            $user->hasRole('Administrator');
        }

        if ($request->role_id && count($request->role_id) > 0) {

            $user->syncRoles($request->role_id);
        }

        session()->flash('Update');
        return redirect('/users');
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->user_id);
        $user->delete();
        session()->flash('Delete');
        return back();
    }
}
