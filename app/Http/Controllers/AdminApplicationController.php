<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminApplicationController extends Controller
{
    //

    public function indexIncoming(Request $request){

//       dd($request->all());
        $search = $request->get('search');
        $perPage = $request->get('perPage', 10); // Default to 2 if not provided
        $type = $request->get('type');
        $pendingApplications = Application::where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('type', 'like', "%{$search}%")
                        ->orWhere('application_id', 'like', "%{$search}%")
                        ->orWhere('applicant_name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->with('house')
            ->paginate($perPage);

        return Inertia::render('Application/Incoming', [
            'application' => $pendingApplications,
            'search' => $search,
            'perPage' => $perPage,
            'type' => $type,

        ]);

    }

    public function indexApproved(Request $request){

//       dd($request->all());
        $search = $request->get('search');
        $perPage = $request->get('perPage', 10); // Default to 2 if not provided
        $type = $request->get('type');
        $pendingApplications = Application::where('status', 'Approved')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('type', 'like', "%{$search}%")
                        ->orWhere('application_id', 'like', "%{$search}%")
                        ->orWhere('applicant_name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->with('house')
            ->paginate($perPage);

        return Inertia::render('Application/Approved', [
            'application' => $pendingApplications,
            'search' => $search,
            'perPage' => $perPage,
            'type' => $type,

        ]);

    }

    public function indexRejected(Request $request){

//       dd($request->all());
        $search = $request->get('search');
        $perPage = $request->get('perPage', 10); // Default to 2 if not provided
        $type = $request->get('type');
        $pendingApplications = Application::where('status', 'Rejected')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('type', 'like', "%{$search}%")
                        ->orWhere('application_id', 'like', "%{$search}%")
                        ->orWhere('applicant_name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->with('house')
            ->paginate($perPage);

        return Inertia::render('Application/Rejected', [
            'application' => $pendingApplications,
            'search' => $search,
            'perPage' => $perPage,
            'type' => $type,

        ]);

    }
    public function viewApplication(Application $application)
    {
//        dd($applicationId);
        try {

            switch ($application->type) {
                case 'ON DUTY':
                    $application->load('onDutyDetails');
                    break;
                case 'NOT ON DUTY':
                    $application->load('notOnDutyDetails');
                    break;
                case 'PRIVATE':
                    $application->load('nonOfficialDetails');
                    break;
                case 'STUDY TOUR':
                    $application->load('studyTourDetails');
                    break;
                case 'FLAM':
                    $application->load('flamDetails');
                    break;
                case 'MEDICAL':
                    $application->load('medicalDetails');
                    break;
            }

            // Optionally always load family members
            $application->load(['familyMembers','house','statusHistories.handler']);
//            dd($application);
            return Inertia::render('Application/Show', [
                'application' => $application
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return a custom error response if application not found
            return response()->json([
                'err' => 'Application not found'
            ], 404);
        }
    }

}
