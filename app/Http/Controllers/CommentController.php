<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, $taskId)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($taskId);
        $task->comments()->create($validated);

        return redirect()->route('tasks.show', $taskId)->with('success', 'Komentārs pievienots!');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validated);

        return redirect()->back()->with('success', 'Komentārs atjaunināts!');
    }


    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->back()->with('success', 'Komentārs dzēsts!');
    }
}
