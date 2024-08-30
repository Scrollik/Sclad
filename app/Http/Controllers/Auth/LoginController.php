<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function create(Request $request): View
    {
        $key = 'login.' . $request->ip();
        return view('welcome', [
            'key' => $key,
            'retries' => RateLimiter::retriesLeft($key, 5),
            'seconds' => RateLimiter::availableIn($key),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => trans('auth.failed')
                ]);
        }
        $request->session()->regenerate();
        RateLimiter::clear('login.'.$request->ip());
        return redirect()->route('dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
