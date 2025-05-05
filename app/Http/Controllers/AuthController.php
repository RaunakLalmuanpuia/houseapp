<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function create(Request $request)
    {
        return inertia('Frontend/Auth/Login',[

        ]);
    }
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));

    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
