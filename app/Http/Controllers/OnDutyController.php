<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\Department;
use App\Models\Otp;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OnDutyController extends Controller
{
    //
    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        $departments = Department::all();
        return Inertia::render('Form/OnDuty/OnDuty',[
            'departments' => $departments,
        ]);
    }

    public function stepThree()
    {
        $states = State::with('houses')->get();
        return Inertia::render('Form/OnDuty/StepThree',[
            'states' => $states,
        ]);
    }

    public function verify(Request $request)
    {
        // Call the sendOtp function and check if it returns true or false
        $isOtpSent = $this->sendOtp($request);

        if ($isOtpSent) {
            // OTP was successfully sent, proceed to render the verification page
            return Inertia::render('Form/OnDuty/Verify');
        } else {
            // OTP sending failed, handle the failure (you can pass an error message if needed)
            return Inertia::render('Form/OnDuty/Verify', [
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
            'gender' => 'required|string|in:Male,Female,Other',
            'designation' => 'required|string|max:255',
            'department' => 'required|integer|exists:departments,id',
            'contact' => 'required|string|max:20',
            'location' => 'required|integer|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department_approval' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'on_duty_details' => 'nullable|array',
            'on_duty_details.*.name' => 'required|string|max:255',
            'on_duty_details.*.gender' => 'required|string|in:Male,Female,Other',
            'on_duty_details.*.designation' => 'required|string|max:255',
            'on_duty_details.*.department' => 'required|string|max:255',
            'on_duty_details.*.contact' => 'required|string|max:20',
            'on_duty_details.*.approval' => 'required|file|mimes:pdf,jpg,jpeg,png,xlsx|max:2048',

            'family_details' => 'nullable|array',
            'family_details.*.name' => 'required|string|max:255',
            'family_details.*.relation' => 'required|string|max:255',
        ]);

        $otp=Otp::query()->where('recipient', $validated['contact'])
            ->where('otp',$validated['otp'])
            ->where('used',false)
            ->first();

        if (blank($otp)) {
            return redirect()->back()->withErrors(['error' => 'Invalid Mobile OTP']);
        }

        DB::beginTransaction();

        try {
            // Store department_approval file
            $deptApprovalFile = $request->file('department_approval');
            $deptApprovalName = random_int(100000, 999999) . '.' . $deptApprovalFile->getClientOriginalExtension();
            $deptApprovalPath = $deptApprovalFile->storeAs('approvals', $deptApprovalName, 'public');

            // Create application
            $application = Application::create([
                'type' => $validated['type'],
                'status' => $validated['status'],
                'application_id' => $this->generateApplicationId(),
                'applicant_name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'designation' => $validated['designation'],
                'department_id' => $validated['department'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'department_approval' => $deptApprovalPath,
            ]);
            // Store OnDutyDetails
            if (!empty($validated['on_duty_details'])){
                foreach ($validated['on_duty_details'] as $detail) {
                    $approvalFile = $detail['approval'];
                    $approvalName = random_int(100000, 999999) . '.' . $approvalFile->getClientOriginalExtension();
                    $approvalPath = $approvalFile->storeAs('approvals/on_duty', $approvalName, 'public');

                    $application->onDutyDetails()->create([
                        'name' => $detail['name'],
                        'gender' => $detail['gender'],
                        'designation' => $detail['designation'],
                        'department_id' => $detail['department'],
                        'contact' => $detail['contact'],
                        'department_approval' => $approvalPath,
                    ]);
                }
            }
            // Store FamilyMembers (if any)
            if (!empty($validated['family_details'])) {
                foreach ($validated['family_details'] as $family) {
                    $application->familyMembers()->create([
                        'name' => $family['name'],
                        'relation' => $family['relation'],
                    ]);
                }
            }

            ApplicationStatusHistory::create([
                'application_id' => $application->id,
                'handled_by' => null,
                'role' => 'applicant',
                'action' => 'submitted',
                'note' => $application->applicant_name . ' submitted the application.',
            ]);

            DB::commit();
            $otp->update(['used'=>true]);
            return redirect()->route('apply.on-duty.submission', ['application' => $application->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home')->with('success', $e->getMessage());

        }
    }

    public function submission(Request $request)
    {

        $applicationId = $request->query('application');

        $application = Application::with(['onDutyDetails', 'house', 'department'])->findOrFail($applicationId);

//        dd($application);
        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }



}
