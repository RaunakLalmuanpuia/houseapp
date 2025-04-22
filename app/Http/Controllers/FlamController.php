<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FlamController extends Controller
{
    //
    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        return Inertia::render('Form/Flam/Flam');
    }

    public function stepThree()
    {
        return Inertia::render('Form/Flam/StepThree');
    }

    public function submit(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'type' => 'required|string',
            'status' => 'required|string',
            'applicant_name' => 'required|string',
            'gender' => 'required|string',
            'designation' => 'required|string',
            'contact' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'flam_details' => 'nullable|array',
            'flam_details.*.flam_name' => 'required|string',
            'flam_details.*.gender' => 'required|string',
            'flam_details.*.designation' => 'required|string',
            'flam_details.*.contact' => 'required|string',
            'family_details' => 'nullable|array',
            'family_details.*.name' => 'required|string',
            'family_details.*.relation' => 'required|string',
        ]);

        $validated['application_id'] = $this->generateApplicationId();
        $application = Application::create($validated);

        if (!empty($validated['flam_details'])) {
            foreach ($validated['flam_details'] as $flam) {
                $application->flamDetails()->create($flam);
            }
        }

        if (!empty($validated['family_details'])) {
            foreach ($validated['family_details'] as $family) {
                $application->familyMembers()->create($family);
            }
        }
//        return redirect()->route('home')->with('success', 'Application submitted!');
        return redirect()->route('apply.flam.submission', ['application' => $application->id]);
    }

    public function submission(Request $request)
    {
        $applicationId = $request->query('application');

        $application = Application::with('flamDetails')->findOrFail($applicationId);

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
