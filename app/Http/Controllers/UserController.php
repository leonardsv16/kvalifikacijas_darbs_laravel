<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ]);

        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Lietotājs veiksmīgi pievienots!');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'role' => 'string',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Lietotājs veiksmīgi atjaunināts!');
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Lietotājs dzēsts!');
    }
}
