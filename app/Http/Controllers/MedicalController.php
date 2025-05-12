<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\MedicalDetail;
use App\Models\Otp;
use App\Models\State;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalController extends Controller
{

    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        return Inertia::render('Form/Medical/Medical');
    }

    public function stepThree()
    {
        $states = State::with('houses')->get();
        return Inertia::render('Form/Medical/StepThree',[
            'states' => $states,
        ]);
    }

    public function verify(Request $request)
    {
        // Call the sendOtp function and check if it returns true or false
        $isOtpSent = $this->sendOtp($request);

        if ($isOtpSent) {
            // OTP was successfully sent, proceed to render the verification page
            return Inertia::render('Form/Medical/Verify');
        } else {
            // OTP sending failed, handle the failure (you can pass an error message if needed)
            return Inertia::render('Form/Medical/Verify', [
                'error' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }
    public function submit(Request $request)
    {
//        dd($request->all());

        // Step 1: Validate main request fields
        $validated = $request->validate([
            'otp' =>'required',
            'type' => 'required|string',
            'status' => 'required|string',
            'category' => 'required|in:Patient,Attendant',
            'service' => 'required|in:Govt,Non-Govt',
            'applicant_name' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'contact' => 'required|string',
            'designation' => 'nullable|string',
            'department' => 'nullable|string',
            'location' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',


            'patient_details' => 'nullable|array',
            'patient_details.*.category' => 'required_with:patient_details|string|in:Patient',
            'patient_details.*.service' => 'required_with:patient_details|string|in:Govt,Non-Govt',
            'patient_details.*.name' => 'required_with:patient_details|string',
            'patient_details.*.gender' => 'required_with:patient_details|in:Male,Female,Other',
            'patient_details.*.contact' => 'required_with:patient_details|string',
            'patient_details.*.designation' => 'nullable|string',
            'patient_details.*.department' => 'nullable|string',
            'patient_details.*.file' => 'nullable|file',

            'attendant_details' => 'nullable|array',
            'attendant_details.*.category' => 'required_with:attendant_details|string|in:Attendant',
            'attendant_details.*.service' => 'required_with:attendant_details|string|in:Govt,Non-Govt',
            'attendant_details.*.name' => 'required_with:attendant_details|string',
            'attendant_details.*.gender' => 'required_with:attendant_details|in:Male,Female,Other',
            'attendant_details.*.contact' => 'required_with:attendant_details|string',
            'attendant_details.*.designation' => 'nullable|string',
            'attendant_details.*.department' => 'nullable|string',
            'attendant_details.*.file' => 'nullable|file',
        ]);


        $otp=Otp::query()->where('recipient', $validated['contact'])
            ->where('otp',$validated['otp'])
            ->where('used',false)
            ->first();

        if (blank($otp)) {
            return redirect()->back()->withErrors(['error' => 'Invalid Mobile OTP']);
        }


        $validated['application_id'] = $this->generateApplicationId();


        // Store main application
        $application = Application::create([
            'type' => $validated['type'],
            'status' => $validated['status'],
            'category' => $validated['category'],
            'service' => $validated['service'],
            'application_id' => $validated['application_id'],
            'applicant_name' => $validated['applicant_name'],
            'gender' => $validated['gender'],
            'contact' => $validated['contact'],
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
            'location' => $validated['location'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        // Step 2: Insert the main applicant as the first medical detail
        MedicalDetail::create([
            'application_id' => $application->id,
            'category' => $validated['category'], // 'Attendant' or 'Patient'
            'service' => $validated['service'],   // 'Govt' or 'Non-Govt'
            'name' => $validated['applicant_name'],
            'gender' => $validated['gender'],
            'contact' =>  $validated['contact'],
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
        ]);


        // Handle Patient details
        if (!empty($validated['patient_details'])) {
            foreach ($validated['patient_details'] as $index => $patient) {
                $filePath = null;
                if ($request->hasFile("patient_details.$index.file")) {
                    $filePath = $request->file("patient_details.$index.file")->store('medical_files', 'public');
                }

                $application->medicalDetails()->create([
                    'category' => $patient['category'],
                    'service' => $patient['service'],
                    'name' => $patient['name'],
                    'gender' => $patient['gender'],
                    'contact' => $patient['contact'],
                    'designation' => $patient['designation'] ?? null,
                    'department' => $patient['department'] ?? null,
                    'file_path' => $filePath,
                ]);

            }
        }

        // Handle Attendant details
        if (!empty($validated['attendant_details'])) {
            foreach ($validated['attendant_details'] as $index => $attendant) {
                $filePath = null;
                if ($request->hasFile("attendant_details.$index.file")) {
                    $filePath = $request->file("attendant_details.$index.file")->store('medical_files', 'public');
                }

                $application->medicalDetails()->create([
                    'category' => $attendant['category'],
                    'service' => $attendant['service'],
                    'name' => $attendant['name'],
                    'gender' => $attendant['gender'],
                    'contact' => $attendant['contact'],
                    'designation' => $attendant['designation'] ?? null,
                    'department' => $attendant['department'] ?? null,
                    'file_path' => $filePath,
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

        $otp->update(['used'=>true]);

        return redirect()->route('apply.medical.submission', ['application' => $application->id]);
    }

    public function submission(Request $request)
    {
//        dd($request->all());
        $applicationId = $request->query('application');

        $application = Application::with(['medicalDetails','house'])->findOrFail($applicationId);

        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }
}
