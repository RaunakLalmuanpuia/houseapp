<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class NotOnDutyController extends Controller
{
    //
    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        return Inertia::render('Form/NotOnDuty/NotOnDuty');
    }

    public function stepThree()
    {
        return Inertia::render('Form/NotOnDuty/StepThree');
    }

    public function submit(Request $request)
    {
//        dd($request->all());

        $validated = $request->validate([
            'type' => 'required|string|in:NOT ON DUTY',
            'status' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other,Select',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'not_on_duty_details' => 'nullable|array',
            'not_on_duty_details.*.name' => 'required|string',
            'not_on_duty_details.*.designation' => 'required|string',
            'not_on_duty_details.*.department' => 'required|string',
            'not_on_duty_details.*.contact' => 'required|string',
            'not_on_duty_details.*.gender' => 'required|string|in:Male,Female,Other,Select',
            'family_details' => 'nullable|array',
            'family_details.*.name' => 'required|string',
            'family_details.*.relation' => 'required|string',
        ]);


        try {
            DB::beginTransaction();

            // Create Application
            $application = Application::create([
                'type' => $request->type,
                'status' => $request->status,
                'application_id' => $this->generateApplicationId(),
                'applicant_name' => $request->applicant_name,
                'gender' => $request->gender,
                'designation' => $request->designation,
                'department' => $request->department,
                'contact' => $request->contact,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // Create Not On Duty Members
            foreach ($request->not_on_duty_details as $detail) {
                $application->notOnDutyDetails()->create([
                    'name' => $detail['name'],
                    'designation' => $detail['designation'],
                    'department' => $detail['department'],
                    'gender' => $detail['gender'],
                    'contact' => $detail['contact'],
                ]);
            }

            // Create Family Members
            if ($request->filled('family_details')) {
                foreach ($request->family_details as $family) {
                    $application->familyMembers()->create([
                        'name' => $family['name'],
                        'relation' => $family['relation'],
                    ]);
                }
            }

            DB::commit();
//            dd($request);
            return redirect()->route('apply.not-on-duty.submission', ['application' => $application->id]);
//            return redirect()->route('home')->with('success', 'Application submitted!');
//            return response()->json(['message' => 'Application submitted successfully'], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('home')->with('success', $e->getMessage());
//            return response()->json(['error' => 'Failed to save application', 'details' => $e->getMessage()], 500);
        }
    }

    public function submission(Request $request)
    {
        $applicationId = $request->query('application');

        $application = Application::with('notOnDutyDetails')->findOrFail($applicationId);

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
