<?php

namespace App\Http\Controllers;

use App\Exports\HouseApplicationExport;
use App\Models\Application;
use App\Models\House;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class HouseReportController extends Controller
{
    //
    public function index(){

        return Inertia::render('HouseReport/Index', [
        ]);
    }

    public function jsonIndex(Request $request)
    {

        $house_id = auth()->user()?->house_id;

        $query = Application::query()
            ->with(['house', 'department'])
            ->where('location', $house_id);
        // Apply filters for status, category, dates, etc.
        $query->when($request->status, function ($q, $status) {
            // If status is selected, filter by that status
            $q->where('status', $status);
            }, function ($q) {
                // Else, exclude pending
                $q->where('status', '!=', 'Pending');
            })
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
                    ->orWhereHas('department', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }
        return response()->json([
            'list' => $query->paginate($request->perPage ?? 15),
        ]);
    }

    public function export(Request $request)
    {

        $house_id = auth()->user()?->house_id;

        $house = House::where('id', $house_id)->first();

        $application = Application::query()
            ->with(['house', 'department'])
            ->where('location', $house_id)
            ->when($request->status, function ($q, $status) {
                // If status is selected, filter by that status
                $q->where('status', $status);
            }, function ($q) {
                // Else, exclude pending
                $q->where('status', '!=', 'Pending');
            })
            ->when($request->category, fn($q) => $q->where('type', $request->category))
            ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
            ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->get();

        $export = new HouseApplicationExport($application, $house);

        return Excel::download($export, now()->timestamp . '.xlsx');
    }

    public function download(Request $request)
    {
        $house_id = auth()->user()?->house_id;

        $house = House::where('id', $house_id)->first();

        $applications = Application::query()
            ->with(['house', 'department'])
            ->where('location', $house_id)
            ->when($request->status, function ($q, $status) {
                // If status is selected, filter by that status
                $q->where('status', $status);
            }, function ($q) {
                // Else, exclude pending
                $q->where('status', '!=', 'Pending');
            })
            ->when($request->category, fn($q) => $q->where('type', $request->category))
            ->when($request->start_date, fn($q) => $q->whereDate('start_date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('end_date', '<=', $request->end_date))
            ->when($request->mizoram_house, fn($q) => $q->where('location', $request->mizoram_house))
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->get();
        // Generate the PDF from the view
        $pdf = PDF\Pdf::loadView('reports.house_report_download', compact(['applications', 'house']));
        // Return the generated PDF as a download
        return $pdf->download('report.pdf');
    }
}
