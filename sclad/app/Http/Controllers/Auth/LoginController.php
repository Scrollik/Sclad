<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public  function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        //validation
        $credentials = $request -> validate([
            'email'=> ['required','string','email'],
            'password'=> ['required','string'],
        ]);
        if(! Auth::attempt($credentials, $request->boolean('remember')))
        {
            return back()
                ->withInput()
                ->withErrors([
                    'email'=>trans('auth.failed')
                ]);

        }
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
    public function destroy (Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
