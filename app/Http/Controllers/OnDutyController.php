<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
        return Inertia::render('Form/OnDuty/OnDuty');
    }

    public function stepThree()
    {
        return Inertia::render('Form/OnDuty/StepThree');
    }



    public function submit(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'type' => 'required|string',
            'status' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|string|max:255',
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
                'department' => $validated['department'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'department_approval' => $deptApprovalPath,
            ]);

            if (!empty($validated['on_duty_details'])){
                foreach ($validated['on_duty_details'] as $detail) {
                    $approvalFile = $detail['approval'];
                    $approvalName = random_int(100000, 999999) . '.' . $approvalFile->getClientOriginalExtension();
                    $approvalPath = $approvalFile->storeAs('approvals/on_duty', $approvalName, 'public');

                    $application->onDutyDetails()->create([
                        'name' => $detail['name'],
                        'gender' => $detail['gender'],
                        'designation' => $detail['designation'],
                        'department' => $detail['department'],
                        'contact' => $detail['contact'],
                        'department_approval' => $approvalPath,
                    ]);
                }
            }
            // Store OnDutyDetails


            // Store FamilyMembers (if any)
            if (!empty($validated['family_details'])) {
                foreach ($validated['family_details'] as $family) {
                    $application->familyMembers()->create([
                        'name' => $family['name'],
                        'relation' => $family['relation'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('apply.on-duty.submission', ['application' => $application->id]);
//            return redirect()->route('home')->with('success', 'Application submitted!');

//            return response()->json([
//                'message' => 'Application created successfully.',
//                'application_id' => $application->id,
//            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home')->with('success', $e->getMessage());
//            return response()->json([
//                'error' => 'Something went wrong.',
//                'details' => $e->getMessage(),
//            ], 500);
        }
    }

    public function submission(Request $request)
    {

        $applicationId = $request->query('application');

        $application = Application::with('onDutyDetails')->findOrFail($applicationId);

        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }
    function generateApplicationId(): string
    {
        do {
            $id = str_pad(random_int(0, 999999999), 6, '0', STR_PAD_LEFT);
        } while (Application::where('application_id', $id)->exists());

        return $id;
    }


}
