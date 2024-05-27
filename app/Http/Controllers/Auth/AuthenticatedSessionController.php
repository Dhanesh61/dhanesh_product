<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
    
        
        if (Auth::attempt($credentials)) {
           
    
           
            $user = Auth::user();
            
            if (Auth::user()->role == "user") {
                return redirect()->intended('/User');
            } else {
                return redirect()->intended('/dash');
            }
                
        }
    
        
        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function storeUser(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == "user") {
                return redirect()->intended('/User');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }

    /**
     * Handle an incoming authentication request for admins.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == "admin") {
                return redirect()->intended('/dash');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required|string',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        // Check if the password was successfully reset
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password reset successful. You can now log in with your new password.');
        } else {
            return back()->with('error', 'Password reset failed. Please try again.');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
