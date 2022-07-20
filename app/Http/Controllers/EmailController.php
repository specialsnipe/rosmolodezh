<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    public function notice()
    {
        return view('auth.verify-email');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
