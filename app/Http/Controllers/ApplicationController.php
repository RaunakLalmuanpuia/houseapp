<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\House;
use App\Models\MedicalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ApplicationController extends Controller
{
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
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'contact' => 'required|string|max:15',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'required|integer|exists:houses,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|string|max:255',
            'department_approval' => 'nullable|file|mimes:pdf|max:2048',

            'on_duty_details' => 'nullable|array',
            'on_duty_details.*.name' => 'required|string|max:255',
            'on_duty_details.*.gender' => 'required|string',
            'on_duty_details.*.contact' => 'required|string|max:15',
            'on_duty_details.*.designation' => 'nullable|string|max:255',
            'on_duty_details.*.department' => 'nullable|string|max:255',
            'on_duty_details.*.department_approval' => 'nullable|file|mimes:pdf|max:2048',

            'family_members' => 'nullable|array',
            'family_members.*.name' => 'required|string|max:255',
            'family_members.*.relation' => 'required|string|max:255',
        ]);



        DB::beginTransaction();
        try {

            // Update basic application fields
            $application->update([

                'applicant_name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'designation' => $validated['designation'],
                'department' => $validated['department'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            // Upload department approval PDF if new file provided
            if ($request->hasFile('department_approval')) {
                $path = $request->file('department_approval')->store('approvals', 'public');
                $application->department_approval = $path;
                $application->save();
            }

            // Handle on duty details
            $application->onDutyDetails()->delete(); // delete existing ones
            if ($request->on_duty_details) {
                foreach ($request->on_duty_details as $index => $duty) {
                    $approvalPath = null;

                    // Handle individual file upload
                    if ($request->hasFile("on_duty_details.$index.department_approval")) {
                        $approvalPath = $request->file("on_duty_details.$index.department_approval")
                            ->store('approvals/on_duty', 'public');
                    } elseif (isset($duty['existing_approval'])) {
                        $approvalPath = $duty['existing_approval']; // retain existing
                    }

                    $application->onDutyDetails()->create([
                        'name' => $duty['name'],
                        'gender' => $duty['gender'],
                        'contact' => $duty['contact'],
                        'designation' => $duty['designation'] ?? null,
                        'department' => $duty['department'] ?? null,
                        'department_approval' => $approvalPath,
                    ]);
                }
            }

            // Handle family members
            $application->familyMembers()->delete();
            if ($request->family_members) {
                foreach ($request->family_members as $member) {
                    $application->familyMembers()->create([
                        'name' => $member['name'],
                        'relation' => $member['relation'],
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
    public function updateNotOnDuty(Request $request, Application $application)
    {
//        dd($request->all());
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'location' => 'required|integer|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'not_on_duty_details' => 'nullable|array',
            'not_on_duty_details.*.name' => 'required|string|max:255',
            'not_on_duty_details.*.gender' => 'required|string|in:Male,Female,Other',
            'not_on_duty_details.*.designation' => 'required|string|max:255',
            'not_on_duty_details.*.department' => 'required|string|max:255',
            'not_on_duty_details.*.contact' => 'required|string|max:20',

            'family_members' => 'nullable|array',
            'family_members.*.name' => 'required|string|max:255',
            'family_members.*.relation' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update Application main fields
            $application->update([
                'applicant_name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'designation' => $validated['designation'],
                'department' => $validated['department'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            // Delete and recreate Not On Duty details
            $application->notOnDutyDetails()->delete();
            if (!empty($validated['not_on_duty_details'])) {
                foreach ($validated['not_on_duty_details'] as $detail) {
                    $application->notOnDutyDetails()->create([
                        'name' => $detail['name'],
                        'gender' => $detail['gender'],
                        'designation' => $detail['designation'],
                        'department' => $detail['department'],
                        'contact' => $detail['contact'],
                    ]);
                }
            }

            // Delete and recreate Family Members
            $application->familyMembers()->delete();
            if (!empty($validated['family_members'])) {
                foreach ($validated['family_members'] as $family) {
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
    public function updateNonOfficial(Request $request, Application $application)
    {
//        dd($request->all());
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'contact' => 'required|string|max:20',
            'location' => 'required|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'non_official_details' => 'nullable|array',
            'non_official_details.*.name' => 'required|string|max:255',
            'non_official_details.*.gender' => 'required|string|in:Male,Female,Other',
            'non_official_details.*.contact' => 'required|string|max:20',
            'family_members' => 'nullable|array',
            'family_members.*.name' => 'required|string|max:255',
            'family_members.*.relation' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            // Update Application main fields
            $application->update([
                'applicant_name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            // Delete and recreate Not On Duty details
            $application->nonOfficialDetails()->delete();
            if (!empty($validated['non_official_details'])) {
                $application->nonOfficialDetails()->createMany($validated['non_official_details']);
            }

            // Replace Family Members
            $application->familyMembers()->delete();
            if (!empty($validated['family_members'])) {
                $application->familyMembers()->createMany($validated['family_members']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Application updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function updateStudyTour(Request $request, Application $application)
    {
//        dd($request->all());
        $validated = $request->validate([
            'type' => 'required|string',
            'applicant_name' => 'required|string',
            'gender' => 'required|string',
            'designation' => 'nullable|string',
            'contact' => 'required|string',
            'location' => 'required|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'study_tour_details.institution' => 'required_if:type,STUDY TOUR|string',
            'study_tour_details.male' => 'required_if:type,STUDY TOUR|integer',
            'study_tour_details.female' => 'required_if:type,STUDY TOUR|integer',
            'study_tour_details.institution_approval' => 'nullable|file',
        ]);

        // Handle file upload
        if ($request->hasFile('study_tour_details.institution_approval')) {
            $file = $request->file('study_tour_details.institution_approval');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('study_tour_approvals', $fileName, 'public');
            $validated['study_tour_details']['institution_approval'] = $path;

        }else {
            // Remove it if not uploaded to avoid setting null
            unset($validated['study_tour_details']['institution_approval']);
        }

        $application->update($validated);

        if ($application->type === 'STUDY TOUR' && isset($validated['study_tour_details'])) {
            $application->studyTourDetails()->updateOrCreate(
                ['application_id' => $application->id],
                $validated['study_tour_details']
            );
        }

        return redirect()->back()->with('success', 'Application updated successfully.');
    }
    public function updateMedical(Request $request, Application $application)
    {
        $validated = $request->validate([

            'applicant_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'contact' => 'required|string|max:15',
            'location' => 'required|exists:houses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'medical_details' => 'required|array|min:1',
            'medical_details.*.name' => 'required|string|max:255',
            'medical_details.*.gender' => 'required|string|in:Male,Female,Other',
            'medical_details.*.contact' => 'required|string|max:20',
            'medical_details.*.category' => 'required|string|max:255',
            'medical_details.*.service' => 'required|string|max:255',
            'medical_details.*.designation' => 'nullable|string|max:255',
            'medical_details.*.department' => 'nullable|string|max:255',
            'medical_details.*.file_path' => 'nullable|file|mimes:pdf|max:2048',
            'medical_details.*.existing_file' => 'nullable|string',

        ]);

        DB::beginTransaction();
        try {
            // Get main applicant from first entry in medical_details
            $mainApplicant = $validated['medical_details'][0];

            // Update Application with main applicant info
            $application->update([
                'applicant_name' => $mainApplicant['name'],
                'gender' => $mainApplicant['gender'],
                'contact' => $mainApplicant['contact'],
                'designation' => $mainApplicant['designation'] ?? null,
                'department' => $mainApplicant['department'] ?? null,
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            // Delete old medical details
            $application->medicalDetails()->delete();

            // Create new medical details
            $newDetails = [];

            foreach ($request->medical_details as $index => $detail) {
                $filePath = null;

                if ($request->hasFile("medical_details.$index.file_path")) {
                    $filePath = $request->file("medical_details.$index.file_path")->store('medical_details', 'public');
                } elseif (!empty($detail['existing_file'])) {
                    $filePath = $detail['existing_file'];
                }

                $newDetails[] = [
                    'name' => $detail['name'],
                    'gender' => $detail['gender'],
                    'contact' => $detail['contact'],
                    'category' => $detail['category'],
                    'service' => $detail['service'],
                    'designation' => $detail['designation'] ?? null,
                    'department' => $detail['department'] ?? null,
                    'file_path' => $filePath,
                ];
            }

            $application->medicalDetails()->createMany($newDetails);

            DB::commit();
            return redirect()->back()->with('success', 'Medical application updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
