<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminApplicationController extends Controller
{
    //

    public function incoming(){
        $pendingApplications = Application::where('status', 'pending')->get();

        return Inertia::render('Application/Incoming', [
            'application' => $pendingApplications
        ]);

    }

}
