<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Mail;

class ResetPassword extends Controller
{
    use Notifiable;

    protected $resetCodes = []; // Store reset codes temporarily

    public function show()
    {
        return view('auth.reset-password');
    }

    public function routeNotificationForMail()
    {
        return request()->email;
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a random 6-digit reset code
            $resetCode = rand(100000, 999999);
            $this->resetCodes[$user->id] = $resetCode; // Store the code in memory for now

            // Send the reset code to the user's email
            Mail::raw("Your password reset code is: $resetCode", function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Password Reset Code');
            });

            return back()->with('success', 'A reset code has been sent to your email address.');
        }

        return back()->withErrors(['email' => 'No user found with this email address.']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && isset($this->resetCodes[$user->id]) && $this->resetCodes[$user->id] == $request->code) {
            return view('auth.reset-password-form', ['email' => $request->email]);
        }

        return back()->withErrors(['code' => 'The provided code is incorrect.']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Clear the reset code
        unset($this->resetCodes[$user->id]);

        return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
    }
}
