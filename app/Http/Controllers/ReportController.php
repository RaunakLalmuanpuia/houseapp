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
//     public function jsonIndex(Request $request){
//
//        $filters = $request->get('filter', []);
//        dd($request);
//        $query = Application::query()
//             ->when(isset($filters['status']), fn($q) => $q->where('status', $filters['status']))
//             ->when(isset($filters['category']), fn($q) => $q->where('type', $filters['category']))
//             ->when(isset($filters['start_date']), fn($q) => $q->whereDate('start_date', '>=', $filters['start_date']))
//             ->when(isset($filters['end_date']), fn($q) => $q->whereDate('end_date', '<=', $filters['end_date']))
//             ->when(isset($filters['mizoram_house']), fn($q) => $q->where('location', $filters['mizoram_house']))
//             ->when(isset($filters['gender']), fn($q) => $q->where('gender', $filters['gender']));
//
//        dd($query->paginate(10));
//         return response()->json([
//             'list' => $query->paginate(),
//         ]);
//     }
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
