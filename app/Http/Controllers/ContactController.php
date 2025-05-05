<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Mail::raw($validated['message'], function ($mail) use ($validated) {
            $mail->to('leonards.v2005@gmail.com')
                 ->subject('Jauns ziņojums no ' . $validated['name'])
                 ->replyTo($validated['email']);
        });

        return redirect()->route('contact.form')->with('success', 'Ziņojums nosūtīts veiksmīgi!');
    }
}
