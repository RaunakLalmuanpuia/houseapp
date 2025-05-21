<?php

namespace App\Http\Controllers;

use App\Exports\AdminApplicationExport;
use App\Models\Application;
use App\Models\House;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
class ReportController extends Controller
{
    //
    public function index(){

        $houses = House::all();
        return Inertia::render('Report/Index', [
           'houses' => $houses
        ]);
    }

//    public function jsonIndex(Request $request)
//    {
//
//        dd($request->all);
//        return response()->json([
//            'list' => Application::query()
//                ->with(['house'])
//                ->when($request->status, fn($q) => $q->where('status', $request->status))
//                ->when($request->category, fn($q) => $q->where('type', $request->category))
//                ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
//                ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
//                ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
//                ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
//                ->paginate($request->perPage),
//        ]);
//    }
    public function jsonIndex(Request $request)
    {
        $query = Application::query()->with(['house', 'department']);

        // Apply filters for status, category, dates, etc.
        $query->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('type', $request->category))
            ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
            ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender));

        // Apply the search filter if search is not null or empty
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('application_id', 'like', "%{$search}%")
                    ->orWhere('applicant_name', 'like', "%{$search}%")
                    ->orWhere('contact', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhereDate('start_date', 'like', "%{$search}%")  // This might not be very useful for dates
                    ->orWhereDate('end_date', 'like', "%{$search}%")    // Same as above
                    ->orWhereHas('house', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('department', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%");
                    });
            });
        }

        return response()->json([
            'list' => $query->paginate($request->perPage ?? 15),
        ]);
    }

    public function export(Request $request)
    {
//        dd($request);
        $application = Application::query()
            ->with(['house', 'department'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('type', $request->category))
            ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
            ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->get();



        $export = new AdminApplicationExport($application);


        return Excel::download($export, now()->timestamp . '.xlsx');

    }

    public function download(Request $request)
    {

        $applications = Application::query()
            ->with(['house', 'department'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('type', $request->category))
            ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
            ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->get();
        // Generate the PDF from the view
        $pdf = PDF\Pdf::loadView('reports.admin_report_download', compact(['applications']));
        // Return the generated PDF as a download
        return $pdf->download('report.pdf');

    }



    public function jsonIndexDepartment(Request $request)
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
