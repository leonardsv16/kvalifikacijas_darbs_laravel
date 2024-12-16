<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $validated = $request->validate([
            'content' => 'required|string',
            'task_id' => 'required|exists:tasks,id',
        ]);

        Comment::create([
            'content' => $validated['content'],
            'task_id' => $validated['task_id'],
            'user_id' => $user->id,
        ]);
        return back()->with('success', 'Comment added successfully!');
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
