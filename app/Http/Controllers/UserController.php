<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function manageUsers() {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $users = User::where('role', 'darbinieks')->get();

        return view('page3', ['users' => $users]);
    }

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.manage')->with('success', 'User updated successfully!');
    }
public function edit($id)
{
    $user = User::findOrFail($id);

    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }


    return view('users.edit', compact('user'));
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
