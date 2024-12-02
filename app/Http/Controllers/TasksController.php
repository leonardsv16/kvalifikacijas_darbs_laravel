<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::with('project')->get();
        return view('tasks.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Uzdevums izveidots!');
    }


    public function show($id)
    {
        $task = Task::with(['comments', 'files'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'status' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Uzdevums atjaunināts!');
    }


    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index')->with('success', 'Uzdevums dzēsts!');
    }
}
