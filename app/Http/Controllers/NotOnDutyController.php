<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Otp;
use App\Models\State;
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
        $states = State::with('houses')->get();
        return Inertia::render('Form/NotOnDuty/StepThree',[
            'states' => $states,
        ]);
    }

    public function verify(Request $request)
    {
        // Call the sendOtp function and check if it returns true or false
        $isOtpSent = $this->sendOtp($request);

        if ($isOtpSent) {
            // OTP was successfully sent, proceed to render the verification page
            return Inertia::render('Form/NotOnDuty/Verify');
        } else {
            // OTP sending failed, handle the failure (you can pass an error message if needed)
            return Inertia::render('Form/NotOnDuty/Verify', [
                'error' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }

    public function submit(Request $request)
    {
//        dd($request->all());

        $validated = $request->validate([
            'otp'=>'required',
            'type' => 'required|string|in:NOT ON DUTY',
            'status' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other,Select',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|integer|exists:houses,id',
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
            $otp->update(['used'=>true]);

            return redirect()->route('apply.not-on-duty.submission', ['application' => $application->id]);


        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('home')->with('success', $e->getMessage());

        }
    }

    public function submission(Request $request)
    {
        $applicationId = $request->query('application');

        $application = Application::with(['notOnDutyDetails', 'house'])->findOrFail($applicationId);

        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }
}
