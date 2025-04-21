<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use App\Models\StudyTour;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudyTourController extends Controller
{
    //
    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        return Inertia::render('Form/StudyTour/StudyTour');
    }

    public function stepThree()
    {
        return Inertia::render('Form/StudyTour/StepThree');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|in:STUDY_TOUR',
            'status' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'designation' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'study_tour_details.institute' => 'required|string|max:255',
            'study_tour_details.male' => 'required|integer|min:0',
            'study_tour_details.female' => 'required|integer|min:0',
            'study_tour_details.institute_approval' => 'required|file|mimes:pdf|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Store application
            $application = Application::create([
                'type' => $request->type,
                'status' => $request->status,
                'application_id' => $this->generateApplicationId(),
                'applicant_name' => $request->applicant_name,
                'gender' => $request->gender,
                'designation' => $request->designation,
                'contact' => $request->contact,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // Handle file upload
            $uploadedFile = $request->file('study_tour_details.institute_approval');
            $fileName = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $uploadedFile->storeAs('study_tour_approvals', $fileName, 'public');

            // Store study tour details
            $application->studyTourDetails()->create([
                'institution' => $request->study_tour_details['institute'],
                'institution_approval' => $filePath,
                'male' => $request->study_tour_details['male'],
                'female' => $request->study_tour_details['female'],
            ]);

            DB::commit();

            return redirect()->route('apply.study-tour.submission', ['application' => $application->id]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    public function submission(Request $request)
    {
        $applicationId = $request->query('application');

        $application = Application::with('studyTourDetails')->findOrFail($applicationId);

        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }

    function generateApplicationId(): string
    {
        do {
            $id = str_pad(random_int(0, 999999999), 9, '0', STR_PAD_LEFT);
        } while (Application::where('application_id', $id)->exists());

        return $id;
    }

}
