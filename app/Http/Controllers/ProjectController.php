<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($validated);
        return redirect()->route('projects.index')->with('success', 'Projekts izveidots!');
    }


    public function show($id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        return view('projects.show', compact('project'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Projekts atjaunināts!');
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->tasks()->delete();
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projekts dzēsts!');
    }
}
