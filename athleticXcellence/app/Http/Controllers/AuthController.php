<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return match(auth()->user()->role) {
                'admin' => redirect()->intended(route('dashboard')),
                default => redirect()->intended(route('welcome')),
            };
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->onlyInput('email');
    }

    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect(route('welcome'));
    }

    // Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

     // Show Reset Password Form
     public function showResetPasswordForm(Request $request, $token)
     {
         return view('auth.reset-password', [
             'token' => $token,
             'email' => $request->email
         ]);
     }
 
     // Handle Password Reset
     public function resetPassword(Request $request)
     {
         $request->validate([
             'token' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:8|confirmed',
         ]);
 
         $status = Password::reset(
             $request->only('email', 'password', 'password_confirmation', 'token'),
             function (User $user, string $password) {
                 $user->forceFill([
                     'password' => Hash::make($password)
                 ])->setRememberToken(Str::random(60));
 
                 $user->save();
 
                 event(new PasswordReset($user));
             }
         );
 
         return $status === Password::PASSWORD_RESET
             ? redirect()->route('login')->with('status', __($status))
             : back()->withErrors(['email' => [__($status)]]);
     }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}