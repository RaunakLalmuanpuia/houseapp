<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\Department;
use App\Models\MedicalDetail;
use App\Models\Otp;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MedicalController extends Controller
{

    public function stepOne()
    {
        return Inertia::render('Form/StepOne');
    }

    public function stepTwo()
    {
        $departments = Department::all();
        return Inertia::render('Form/Medical/Medical',[
            'departments' => $departments,
        ]);
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
            'number_of_persons' => 'required|integer',
            'designation' => 'nullable|string',
            'department' => 'nullable|integer|exists:departments,id',
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
            'patient_details.*.department' => 'nullable|integer|exists:departments,id',
            'patient_details.*.file' => 'nullable|file',

            'attendant_details' => 'nullable|array',
            'attendant_details.*.category' => 'required_with:attendant_details|string|in:Attendant',
            'attendant_details.*.service' => 'required_with:attendant_details|string|in:Govt,Non-Govt',
            'attendant_details.*.name' => 'required_with:attendant_details|string',
            'attendant_details.*.gender' => 'required_with:attendant_details|in:Male,Female,Other',
            'attendant_details.*.contact' => 'required_with:attendant_details|string',
            'attendant_details.*.designation' => 'nullable|string',
            'attendant_details.*.department' => 'nullable|integer|exists:departments,id',
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
        try {
            DB::beginTransaction();

            // Store main application
            $application = Application::create([
                'type' => $validated['type'],
                'status' => $validated['status'],
                'application_id' => $validated['application_id'],
                'applicant_name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'contact' => $validated['contact'],
                'number_of_persons'=> $validated['number_of_persons'],
                'designation' => $validated['designation'] ?? null,
                'department_id' => $validated['department'] ?? null,
                'location' => $validated['location'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);

            $filePath = null;
            if ($request->hasFile("file")) {
                $file = $request->file('file');
                $filePath = random_int(100000, 999999) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('medical', $filePath, 'public');
            }

            // Step 2: Insert the main applicant as the first medical detail
            MedicalDetail::create([
                'application_id' => $application->id,
                'category' => $validated['category'], // 'Attendant' or 'Patient'
                'service' => $validated['service'],   // 'Govt' or 'Non-Govt'
                'name' => $validated['applicant_name'],
                'gender' => $validated['gender'],
                'contact' =>  $validated['contact'],
                'designation' => $validated['service'] === 'Non-Govt' ? null : ($validated['designation'] ?? null),
                'department_id' => $validated['service'] === 'Non-Govt' ? null : ($validated['department'] ?? null),
                'file_path' => $filePath,
            ]);


            // Handle Patient details
            if (!empty($validated['patient_details'])) {
                foreach ($validated['patient_details'] as $index => $patient) {
                    $filePath = null;
                    if ($request->hasFile("patient_details.$index.file")) {
                        $file = $request->file("patient_details.$index.file");
                        $filePath = random_int(100000, 999999) . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('medical', $filePath, 'public');
                    }

                    $application->medicalDetails()->create([
                        'category' => $patient['category'],
                        'service' => $patient['service'],
                        'name' => $patient['name'],
                        'gender' => $patient['gender'],
                        'contact' => $patient['contact'],
                        'designation' => $patient['service'] === 'Non-Govt' ? null : ($patient['designation'] ?? null),
                        'department_id' => $patient['service'] === 'Non-Govt' ? null : ($patient['department'] ?? null),
                        'file_path' => $filePath,
                    ]);

                }
            }

            // Handle Attendant details
            if (!empty($validated['attendant_details'])) {
                foreach ($validated['attendant_details'] as $index => $attendant) {
                    $filePath = null;
                    if ($request->hasFile("attendant_details.$index.file")) {
                        $file = $request->file("attendant_details.$index.file");
                        $filePath = random_int(100000, 999999) . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('approvals', $filePath, 'public');
                    }

                    $application->medicalDetails()->create([
                        'category' => $attendant['category'],
                        'service' => $attendant['service'],
                        'name' => $attendant['name'],
                        'gender' => $attendant['gender'],
                        'contact' => $attendant['contact'],
                        'designation' => $attendant['service'] === 'Non-Govt' ? null : ($attendant['designation'] ?? null),
                        'department_id' => $attendant['service'] === 'Non-Govt' ? null : ($attendant['department'] ?? null),
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



            DB::commit();
            $otp->update(['used'=>true]);

            return redirect()->route('apply.medical.submission', ['application' => $application->id]);


        } catch (\Exception $e) {
            DB::rollBack();
//            return redirect()->route('apply.medical.submission', ['application' => $application->id]);
//            dd($e->getMessage());
            return redirect()->route('home')->with('success', $e->getMessage());

        }
    }

    public function submission(Request $request)
    {
//        dd($request->all());
        $applicationId = $request->query('application');

        $application = Application::with(['medicalDetails','house','department'])->findOrFail($applicationId);

        return Inertia::render('Form/Submission', [
            'application' => $application
        ]);
    }
}
