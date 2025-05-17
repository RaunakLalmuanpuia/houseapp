<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf; // Assuming you're using DomPDF


use App\Http\Controllers\DigilockerController;
use Inertia\Inertia;

class AuthController extends Controller
{
    //

    public function create(){
        return inertia('Frontend/Auth/Login', []);
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

        return Inertia::location('/');

    }
}
