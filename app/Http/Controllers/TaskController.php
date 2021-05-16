<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\User;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required'
        ]);

        Task::create([
            'subject' => $request->subject,
            'user_id' => auth()->id()
        ]);
        session()->flash('Add');
        return redirect('tasks');
    }

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        // if user has role == Administrator ==> get all users and him
        // if user regular ==> give him only him
        $user = auth()->user();
        $users = collect();
        if ($user->hasRole('Administrator')) {
            $users = User::all();
        } else {
            $users = User::where('id', $user->id)->get();
        }
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $attrs = $request->only(['subject', 'date', 'dedicated_time', 'estimated_time', 'client_id', 'user_id', 'time']);

        // if ($request->has('time')) {
        //     $timestamp = strtotime($request->time);
        //     $attrs['time'] = $timestamp;
        // }

        if (!$request->user_id) {
            $attrs['user_id'] = auth()->id();
        }
        if ($request->completed == 'on') {
            $attrs['completed'] = 1;
        }
        if ($request->important == 'on') {
            $attrs['important'] = 1;
        }

        $task->update($attrs);
        session()->flash('Update');
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
