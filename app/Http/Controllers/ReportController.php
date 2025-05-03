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

    public function jsonIndex(Request $request)
    {


        return response()->json([
            'list' => Application::query()
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->when($request->category, fn($q) => $q->where('type', $request->category))
                ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
                ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
                ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
                ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
                ->paginate($request->perPage),
        ]);
    }


}
