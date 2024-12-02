<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function store(Request $request, $taskId)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/files');

        $task = Task::findOrFail($taskId);
        $task->files()->create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return redirect()->route('tasks.show', $taskId)->with('success', 'Fails pievienots!');
    }


    public function destroy($id)
    {
        $file = File::findOrFail($id);
        Storage::delete($file->path);
        $file->delete();

        return redirect()->back()->with('success', 'Fails dzēsts!');
    }


    public function download($id)
    {
        $file = File::findOrFail($id);
        return Storage::download($file->path, $file->name);
    }
}
