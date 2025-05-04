<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use Illuminate\Http\Request;

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

}
