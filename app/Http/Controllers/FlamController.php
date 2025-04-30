<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Otp;
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

    public function verify(Request $request)
    {
        // Call the sendOtp function and check if it returns true or false
        $isOtpSent = $this->sendOtp($request);

        if ($isOtpSent) {
            // OTP was successfully sent, proceed to render the verification page
            return Inertia::render('Form/Flam/Verify');
        } else {
            // OTP sending failed, handle the failure (you can pass an error message if needed)
            return Inertia::render('Form/Flam/Verify', [
                'error' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }

    public function submit(Request $request)
    {
//        dd($request->all());

        $validated = $request->validate([
            'otp'=>'required',
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


        $otp=Otp::query()->where('recipient', $validated['contact'])
            ->where('otp',$validated['otp'])
            ->where('used',false)
            ->first();

        if (blank($otp)) {
            return redirect()->back()->withErrors(['error' => 'Invalid Mobile OTP']);
        }


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

        $otp->update(['used'=>true]);
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

}
