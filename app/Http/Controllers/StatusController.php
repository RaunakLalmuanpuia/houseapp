<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatusController extends Controller
{
    //
    public function index(){
        return Inertia::render('Status/Index', [
        ]);
    }

    public function getStatus($applicationId)
    {
        try {
            // Try to fetch the application by its application_id
            $application = Application::where('application_id', $applicationId)->firstOrFail();

            // Optionally load related data based on application type
            // $this->loadRelatedData($application);

            return response()->json([
                'data' => $application
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return a custom error response if application not found
            return response()->json([
                'err' => 'Application not found'
            ], 404);
        }
    }

    public function show($applicationId)
    {
//        dd($applicationId);
        try {
            // Try to fetch the application by its application_id
            $application = Application::where('application_id', $applicationId)->firstOrFail();

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
            }

            // Optionally always load family members
            $application->load(['familyMembers', 'house']);
//        dd($application);
            return Inertia::render('Status/Show', [
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
