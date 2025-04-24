<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    //
    public function index(){

        return Inertia::render('Report/Index', [
            'application' => Application::where('status', "asdasds")->paginate(10),
        ]);
    }
}
