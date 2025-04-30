<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class NonOfficialController extends Controller
{
    //
    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        return Inertia::render('Form/NonOfficial/NonOfficial');
    }

    public function stepThree()
    {
        return Inertia::render('Form/NonOfficial/StepThree');
    }
    public function verify(Request $request)
    {
        // Call the sendOtp function and check if it returns true or false
        $isOtpSent = $this->sendOtp($request);

        if ($isOtpSent) {
            // OTP was successfully sent, proceed to render the verification page
            return Inertia::render('Form/NonOfficial/Verify');
        } else {
            // OTP sending failed, handle the failure (you can pass an error message if needed)
            return Inertia::render('Form/NonOfficial/Verify', [
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
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other,Select',
            'contact' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'non_official_details' => 'nullable|array',
            'non_official_details.*.name' => 'required|string',
            'non_official_details.*.contact' => 'required|string',
            'non_official_details.*.gender' => 'required|string|in:Male,Female,Other,Select',
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


        try {
            DB::beginTransaction();

            // Create Application
            $application = Application::create([
                'type' => $request->type,
                'status' => $request->status,
                'application_id' => $this->generateApplicationId(),
                'applicant_name' => $request->applicant_name,
                'gender' => $request->gender,
                'contact' => $request->contact,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // Create Not Official Members
            foreach ($request->non_official_details as $detail) {
                $application->nonOfficialDetails()->create([
                    'name' => $detail['name'],
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
            $otp->update(['used'=>true]);
            return redirect()->route('apply.non-official.submission', ['application' => $application->id]);
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
