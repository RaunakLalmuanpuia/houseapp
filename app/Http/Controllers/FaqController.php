<?php

namespace App\Http\Controllers;


use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10);


        $faqs = Faq::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->paginate($perPage);

        return Inertia::render('Faqs/Index', [
            'faqs' => $faqs,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }


    public function store(Request $request)
    {

//        dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Published,Draft,Archived',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully.');
    }

    public function update(Request $request, Faq $faq)
    {
//        dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Published,Draft,Archived',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
//        dd($faq);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully.');
    }




}
