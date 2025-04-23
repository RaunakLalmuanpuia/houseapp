<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminApplicationController extends Controller
{
    //

    public function incoming(Request $request){

//       dd($request->all());
        $search = $request->get('search');
        $perPage = $request->get('perPage', 10); // Default to 2 if not provided
        $type = $request->get('type');
        $pendingApplications = Application::where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('type', 'like', "%{$search}%")
                        ->orWhere('application_id', 'like', "%{$search}%")
                        ->orWhere('applicant_name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->paginate($perPage);

        return Inertia::render('Application/Incoming', [
            'application' => $pendingApplications,
            'search' => $search,
            'perPage' => $perPage,
            'type' => $type,

        ]);

    }

}
