<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    //
    public function forward(Request $request, Application $application)
    {
//        dd($request->all());
        $user = auth()->user();

        // Update status
        $application->update([
            'status' => 'forwarded',
            'status_changed_at' => now(),
        ]);

        // Log status change
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'handled_by' => $user->id,
            'role' => $user->getRoleNames()->first(),
            'action' => 'forwarded',
            'note' => $request->note,
            'priority' => $request->priority,
        ]);

        return back()->with('success', 'Application forwarded to house user.');
    }

    public function approve(Request $request, Application $application)
    {
        $user = auth()->user();

        $application->update([
            'status' => 'approved',
            'status_changed_at' => now(),
        ]);

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'handled_by' => $user->id,
            'role' => $user->getRoleNames()->first(),
            'action' => 'approved',
            'note' => $request->note,
        ]);
        return back()->with('success', 'Application approved.');
    }

    public function reject(Request $request, Application $application)
    {
        $user = auth()->user();

        $application->update([
            'status' => 'rejected',
            'reject_reason' => $request->input('reject_reason'),
            'status_changed_at' => now(),
        ]);

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'handled_by' => $user->id,
            'role' => $user->getRoleNames()->first(),
            'action' => 'rejected',
            'note' => $request->input('reject_reason'),
        ]);
        return back()->with('success', 'Application Rejected.');
    }

    public function edit(Request $request, Application $application){
//        dd($application);

        $house = House::all();

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
            case 'MEDICAL':
                $application->load('medicalDetails');
                break;
        }

        // Optionally always load family members
        $application->load(['familyMembers','house']);

        return Inertia::render('Application/Edit', [
            'application' => $application,
            'house' => $house,
        ]);
    }

    public function updateFlam(Request $request, Application $application){
//        dd($request->all());

        $request->validate([
            'gender' => 'required|string',
            'designation' => 'required|string',
            'contact' => 'required|string',
            'location' => 'required|integer|exists:houses,id',
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

        DB::beginTransaction();

        try {

            $application->update([
                'applicant_name' => $request->applicant_name,
                'gender' => $request->gender,
                'contact' => $request->contact,
                'designation' => $request->designation,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // 2. Update FLAM Details
            $application->flamDetails()->delete(); // delete all existing ones

            foreach ($request->flam_details as $flam) {
                $application->flamDetails()->create([
                    'flam_name' => $flam['flam_name'] ?? null,
                    'gender' => $flam['gender'] ?? null,
                    'designation' => $flam['designation'] ?? null,
                    'contact' => $flam['contact'] ?? null,
                ]);
            }

            // 3. Update Family Members
            $application->familyMembers()->delete(); // delete all existing ones

            foreach ($request->family_members as $member) {
                $application->familyMembers()->create([
                    'name' => $member['name'] ?? null,
                    'relation' => $member['relation'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Application updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function updateOnDuty(Request $request, Application $application)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'status' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|integer|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'department_approval_file' => 'nullable|mimes:pdf,jpg,jpeg,png,xlsx|max:2048',
            'on_duty_details' => 'nullable|array',
            'on_duty_details.*.name' => 'required|string|max:255',
            'on_duty_details.*.gender' => 'required|string|in:Male,Female,Other',
            'on_duty_details.*.designation' => 'required|string|max:255',
            'on_duty_details.*.department' => 'required|string|max:255',
            'on_duty_details.*.contact' => 'required|string|max:20',
            'on_duty_details.*.department_approval_file' => 'nullable|mimes:pdf,jpg,jpeg,png,xlsx|max:2048',
            'family_details' => 'nullable|array',
            'family_details.*.name' => 'required|string|max:255',
            'family_details.*.relation' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update application fields
            $application->update([
                'gender' => $validated['gender'],
                'designation' => $validated['designation'],
                'department' => $validated['department'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            // Check if a new department_approval file is uploaded, and update if necessary
            if ($request->hasFile('department_approval_file')) {
                $deptApprovalFile = $request->file('department_approval_file');
                $deptApprovalName = random_int(100000, 999999) . '.' . $deptApprovalFile->getClientOriginalExtension();
                $deptApprovalPath = $deptApprovalFile->storeAs('approvals', $deptApprovalName, 'public');
                $application->department_approval = $deptApprovalPath;  // Only update if a new file is uploaded
            }

            // Delete old on duty details and recreate
            $application->onDutyDetails()->delete();

            if (!empty($validated['on_duty_details'])) {
                foreach ($validated['on_duty_details'] as $index => $detail) {
                    $approvalPath = $detail['department_approval'] ?? '';  // Keep existing value if no new file uploaded

                    // If a new department_approval file is uploaded for this detail, update the path
                    if ($request->hasFile("on_duty_details.$index.department_approval_file")) {
                        $file = $request->file("on_duty_details.$index.department_approval_file");
                        $fileName = random_int(100000, 999999) . '.' . $file->getClientOriginalExtension();
                        $approvalPath = $file->storeAs('approvals', $fileName, 'public');
                    }

                    // Store the on duty details with the department_approval path
                    $application->onDutyDetails()->create([
                        'name' => $detail['name'],
                        'gender' => $detail['gender'],
                        'designation' => $detail['designation'],
                        'department' => $detail['department'],
                        'contact' => $detail['contact'],
                        'department_approval' => $approvalPath,  // Use existing path if no new file uploaded
                    ]);
                }
            }

            // Delete and recreate family members
            $application->familyMembers()->delete();
            if (!empty($validated['family_details'])) {
                foreach ($validated['family_details'] as $family) {
                    $application->familyMembers()->create([
                        'name' => $family['name'],
                        'relation' => $family['relation'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Application updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}
