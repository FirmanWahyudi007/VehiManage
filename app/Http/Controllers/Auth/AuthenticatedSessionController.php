<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Models\LogMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

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
        //login email or username
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$fieldType => $request->email]);
        //attempt login
        if (!Auth::attempt($request->only($fieldType, 'password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();
        //log message
        $user = Auth::user();
        LogMessage::create([
            'user_id' => $user->id,
            'message' => 'User ' . $user->name . ' logged in.',
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        //log message
        $user = Auth::user();
        LogMessage::create([
            'user_id' => $user->id,
            'message' => 'User ' . $user->name . ' logged out.',
        ]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
