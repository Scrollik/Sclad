<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrerController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_sotr' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role_rab' => ['sometimes', 'required'],
        ]);
        User::create([
            'name' => $request->name_sotr,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role_rab,
        ]);
        return redirect('/dashboard');
    }
}
