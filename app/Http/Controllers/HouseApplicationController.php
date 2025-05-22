<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HouseApplicationController extends Controller
{
    //
    public function indexIncoming(Request $request){

//       dd($request->all());
        $search = $request->get('search');
        $perPage = $request->get('perPage', 10); // Default to 2 if not provided
        $type = $request->get('type');


        $user = auth()->user();

        // Make sure user has 'house_user' role
        if (!$user->hasRole('House')) {
            abort(403, 'Unauthorized');
        }


        $pendingApplications = Application::where('status', 'forwarded')
            ->where('location', $user->house_id)
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
            ->with(['house','department','studyTourDetails'])
            ->paginate($perPage);

        // Conditionally eager load studyTourDetails for only STUDY TOUR
        $pendingApplications->getCollection()->load([
            'studyTourDetails' => function ($query) {
                $query->select('application_id', 'institution');
            }
        ]);

        // Filter loaded studyTourDetails only for STUDY TOUR type
        $pendingApplications->getCollection()->each(function ($application) {
            if ($application->type !== 'STUDY TOUR') {
                $application->unsetRelation('studyTourDetails');
            }
        });


        return Inertia::render('HouseApplications/Incoming', [
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

        $user = auth()->user();

        // Make sure user has 'house_user' role
        if (!$user->hasRole('House')) {
            abort(403, 'Unauthorized');
        }

        $pendingApplications = Application::where('status', 'Approved')
            ->where('location', $user->house_id)
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
            ->with(['house','department','studyTourDetails'])
            ->paginate($perPage);

        // Conditionally eager load studyTourDetails for only STUDY TOUR
        $pendingApplications->getCollection()->load([
            'studyTourDetails' => function ($query) {
                $query->select('application_id', 'institution');
            }
        ]);

        // Filter loaded studyTourDetails only for STUDY TOUR type
        $pendingApplications->getCollection()->each(function ($application) {
            if ($application->type !== 'STUDY TOUR') {
                $application->unsetRelation('studyTourDetails');
            }
        });

        return Inertia::render('HouseApplications/Approved', [
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


        $user = auth()->user();

        // Make sure user has 'house_user' role
        if (!$user->hasRole('House')) {
            abort(403, 'Unauthorized');
        }


        $pendingApplications = Application::where('status', 'Rejected')
            ->where('location', $user->house_id)
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
            ->with(['house','department'])
            ->paginate($perPage);

        // Conditionally eager load studyTourDetails for only STUDY TOUR
        $pendingApplications->getCollection()->load([
            'studyTourDetails' => function ($query) {
                $query->select('application_id', 'institution');
            }
        ]);

        // Filter loaded studyTourDetails only for STUDY TOUR type
        $pendingApplications->getCollection()->each(function ($application) {
            if ($application->type !== 'STUDY TOUR') {
                $application->unsetRelation('studyTourDetails');
            }
        });

        return Inertia::render('HouseApplications/Rejected', [
            'application' => $pendingApplications,
            'search' => $search,
            'perPage' => $perPage,
            'type' => $type,

        ]);

    }
    public function viewApplication(Application $application)
    {
//        dd($application);
        try {

            switch ($application->type) {
                case 'ON DUTY':
                    $application->load('onDutyDetails.department');
                    break;
                case 'NOT ON DUTY':
                    $application->load('notOnDutyDetails.department');
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
                    $application->load('medicalDetails.department');
                    break;
            }

            // Optionally always load family members
            $application->load(['familyMembers','house','statusHistories.handler', 'department']);
//            dd($application);
            return Inertia::render('HouseApplications/Show', [
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
