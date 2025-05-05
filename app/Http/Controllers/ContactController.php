<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contacts');
    }

    public function submitForm(Request $request)
    {

        // Mail::raw('Test message from Laravel', function($message) {
        //     $message->to('leonards.v2005@gmail.com')
        //             ->subject('Test message from Laravel')
        //             ->from('no-reply@example.com');
        // });

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($mail) use ($validated) {
            $mail->to('leonards.v2005@gmail.com')
                    ->subject('New message from' . $validated['name'])
                    ->from($validated['email']);
        });

        return redirect()->route('contacts.form')->with('success', 'Message sent succesfully.');
    }
}
