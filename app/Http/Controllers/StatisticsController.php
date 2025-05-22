<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
class StatisticsController extends Controller
{

    public function getStatistics()
    {
        return response()->json([
            'submitted' => Application::count(),
            'approved' => Application::where('status', 'approved')->count(),
            'categories' => [
                'flam' => Application::where('type', 'FLAM')->count(),
                'on_duty' => Application::where('type', 'ON DUTY')->count(),
                'not_on_duty' => Application::where('type', 'NOT ON DUTY')->count(),
                'medical' => Application::where('type', 'MEDICAL')->count(),
                'private' => Application::where('type', 'PRIVATE')->count(),
                'study_tour' => Application::where('type', 'STUDY TOUR')->count(),
            ]
        ]);
    }

    public function getReservation(Request $request)
    {

        $year = $request->year;
        $types = [
            'FLAM',
            'ON DUTY',
            'NOT ON DUTY',
            'PRIVATE',
            'MEDICAL',
            'STUDY TOUR',
        ];

        $result = [];

        foreach ($types as $type) {
            $monthlyCounts = Application::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
                ->where('type', $type)
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');

            // Fill missing months with 0
            $counts = [];
            for ($m = 1; $m <= 12; $m++) {
                $counts[] = $monthlyCounts[$m] ?? 0;
            }

            $result[] = [
                'label' => $type,
                'data' => $counts
            ];
        }

        return response()->json($result);
    }

    public function getCategory()
    {
        // Define the types you want to include in the response
        $types = ['FLAM', 'ON DUTY', 'NOT ON DUTY', 'PRIVATE', 'MEDICAL', 'STUDY TOUR'];

        // For each type, count the number of applications
        $data = collect($types)->map(function ($type) {
            return [
                'label' => $type,
                'count' => Application::where('type', $type)->count(),
            ];
        });

        return response()->json($data);
    }
    public function getCategoryPercentage()
    {
        // Define the types you want to include in the response
        $types = ['FLAM', 'ON DUTY', 'NOT ON DUTY', 'PRIVATE', 'MEDICAL', 'STUDY TOUR'];

        // Get total count of all applications with those types
        $totalCount = Application::whereIn('type', $types)->count();

        // Avoid division by zero
        if ($totalCount === 0) {
            // Return zero percentages if no applications found
            $data = collect($types)->map(fn($type) => [
                'label' => $type,
                'percentage' => 0,
            ]);
            return response()->json($data);
        }

        // Calculate percentage for each type
        $data = collect($types)->map(function ($type) use ($totalCount) {
            $count = Application::where('type', $type)->count();
            $percentage = ($count / $totalCount) * 100;

            return [
                'label' => $type,
                'percentage' => round($percentage, 2),  // rounded to 2 decimals
            ];
        });

        return response()->json($data);
    }

    public function getStatus()
    {
        $incomingCount = Application::where('status', 'pending')->count();
        $forwardedCount =Application::where('status', 'forwarded')->count();
        $approvedCount = Application::where('status', 'approved')->count();
        $rejectedCount = Application::where('status', 'rejected')->count();
        $allCount = Application::count();

        return response()->json([
            'incoming' => $incomingCount,
            'forwarded' => $forwardedCount,
            'approved' => $approvedCount,
            'rejected' => $rejectedCount,
            'all' => $allCount,
        ]);
    }
    public function getApplicationCounts()
    {
        // Get counts grouped by 'type'
        $counts = Application::select('type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type'); // pluck count by type for easy access

        // Ensure all known types appear with 0 if missing
        $types = ['FLAM', 'ON DUTY', 'NOT ON DUTY', 'MEDICAL', 'PRIVATE', 'STUDY TOUR'];
        $result = [];
        foreach ($types as $type) {
            $result[$type] = $counts->get($type, 0);
        }

        return response()->json($result);
    }

    public function getStatusHouse()
    {
        $house_id = auth()->user()?->house_id;
        // Only count applications where location matches the user's house_id
        $incomingCount = Application::where('status', 'forwarded')
            ->where('location', $house_id)
            ->count();

        $approvedCount = Application::where('status', 'approved')
            ->where('location', $house_id)
            ->count();

        $rejectedCount = Application::where('status', 'rejected')
            ->where('location', $house_id)
            ->count();

        // Total is the sum of the three counts
        $allCount = $incomingCount + $approvedCount + $rejectedCount;

        return response()->json([
            'incoming' => $incomingCount,
            'approved' => $approvedCount,
            'rejected' => $rejectedCount,
            'all' => $allCount,
        ]);
    }
    public function getApplicationCountsHouse()
    {

        // Get counts grouped by 'type'
        $house_id = auth()->user()?->house_id;

        $counts = Application::select('type')
            ->where('location', $house_id)
            ->where('status', '!=', 'pending') // exclude pending status
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type'); // pluck count by type for easy access

        // Ensure all known types appear with 0 if missing
        $types = ['FLAM', 'ON DUTY', 'NOT ON DUTY', 'MEDICAL', 'PRIVATE', 'STUDY TOUR'];
        $result = [];
        foreach ($types as $type) {
            $result[$type] = $counts->get($type, 0);
        }

        return response()->json($result);
    }




}
