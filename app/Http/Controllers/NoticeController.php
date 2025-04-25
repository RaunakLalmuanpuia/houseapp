<?php

namespace App\Http\Controllers;


use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class NoticeController extends Controller
{
    //

    public function index(Request $request)
    {

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10);


        $notice = Notice::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        return Inertia::render('Notice/Index', [
            'notice' => $notice,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function store(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx',
            'status' => 'required|in:Published,Draft,Archived',
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $uniqueName = uniqid('notice_') . '.' . $file->getClientOriginalExtension();
            $validated['document'] = $file->storeAs('notices', $uniqueName, 'public');
        }

        Notice::create($validated);

        return redirect()->route('admin.notice.index')->with('success', 'Notice created successfully.');
    }



    public function update(Request $request, Notice $notice)
    {
//        dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx',
            'status' => 'required|in:Published,Draft,Archived',
        ]);

        if ($request->hasFile('document')) {
            if ($notice->document) {
                Storage::disk('public')->delete($notice->document);
            }

            $file = $request->file('document');
            $uniqueName = uniqid('notice_') . '.' . $file->getClientOriginalExtension();
            $validated['document'] = $file->storeAs('notices', $uniqueName, 'public');
        }

        $notice->update($validated);

        return redirect()->route('admin.notice.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        if ($notice->document) {
            Storage::disk('public')->delete($notice->document);
        }

        $notice->delete();

        return redirect()->route('admin.notice.index')->with('success', 'Notice deleted successfully.');
    }



}
