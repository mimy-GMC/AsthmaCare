<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        $details = [
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ];

        try {
            Mail::to('celestegakosso234@gmail.com')->send(new ContactMessage($details));

            return back()->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons dès que possible.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer plus tard.');
        }
    }
}
