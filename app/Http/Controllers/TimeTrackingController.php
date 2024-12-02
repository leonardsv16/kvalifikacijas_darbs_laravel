<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TimeTrackingController extends Controller
{

    public function store(Request $request, $taskId)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'hours_spent' => 'required|numeric|min:0.1',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($taskId);
        $task->timeTracking()->create($validated);

        return redirect()->route('tasks.show', $taskId)->with('success', 'Laika ieraksts pievienots!');
    }


    public function update(Request $request, $id, $task)
    {
        $validated = $request->validate([
            'hours_spent' => 'required|numeric|min:0.1',
            'description' => 'nullable|string',
        ]);

        $timeTracking = $task->timeTracking()->findOrFail($id);
        $timeTracking->update($validated);

        return redirect()->back()->with('success', 'Laika ieraksts atjaunināts!');
    }

    public function destroy($id, $task)
    {
        $timeTracking = $task->timeTracking()->findOrFail($id);
        $timeTracking->delete();

        return redirect()->back()->with('success', 'Laika ieraksts dzēsts!');
    }
}
