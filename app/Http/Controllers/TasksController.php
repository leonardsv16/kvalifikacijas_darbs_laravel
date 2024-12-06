<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function index()
{

    $tasks = [
        'not_started' => Task::where('status', 'Not started')->get(),
        'started' => Task::where('status', 'Started')->get(),
        'finished' => Task::where('status', 'Finished')->get(),
        'checked' => Task::where('status', 'Checked')->get(),
    ];


    $users = User::all();
    $projects = Project::all();


    return view('tasks', compact('tasks', 'users', 'projects'));
}


    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|string|in:Not started,Started,Finished,Checked',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'user_id' => 'required|exists:users,id',
        'project_id' => 'required|exists:projects,id',
    ]);


    Task::create($validated);

    return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
}



    public function show($id)
    {
        $task = Task::with(['comments', 'files'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }


    public function update(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $task->title = $request->title;
        $task->status = $request->status;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }



    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index')->with('success', 'Task deletef');
    }
}
