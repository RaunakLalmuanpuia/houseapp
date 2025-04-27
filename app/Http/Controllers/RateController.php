<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RateCategory;
use App\Models\RoomRate;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RateController extends Controller
{
    //
    public function index(Request $request){

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10);

        // Fetch all Houses with their Room Types
        $houses = House::with('roomTypes')->get();

        // Fetch all Rate Categories
        $categories = RateCategory::all();


//        $roomRates = RoomRate::with(['roomType.house', 'rateCategory'])->get();

        $roomRates = RoomRate::with(['roomType.house', 'rateCategory'])
            ->when($search, function ($query, $search) {
                $query->whereHas('roomType.house', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('roomType', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('rateCategory', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->paginate($perPage);

        return Inertia::render('Rate/Index', [
            'houses' => $houses,
            'categories' => $categories,
            'roomRates' => $roomRates,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

//    public function store(Request $request)
//    {
////        dd($request);
//        $validated = $request->validate([
//            'room_type_id' => 'required|exists:room_types,id',
//            'rate_category_id' => 'required|exists:rate_categories,id',
//            'rate' => 'required|numeric',
//        ]);
//
//        $roomRate = RoomRate::create($validated);
//
//        return redirect()->route('admin.rate.index')->with('success', 'Room rate created successfully');
//
//    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'rate_category_id' => 'required|exists:rate_categories,id',
            'rate' => 'required|numeric',
        ]);

        // Check if a RoomRate already exists for the same room_type_id and rate_category_id
        $existingRate = RoomRate::where('room_type_id', $validated['room_type_id'])
            ->where('rate_category_id', $validated['rate_category_id'])
            ->first();

        if ($existingRate) {
            return redirect()->back()->withErrors('Rate for this Room Type and Category already exists.');
        }

        $roomRate = RoomRate::create($validated);

        return redirect()->route('admin.rate.index')->with('success', 'Room rate created successfully');
    }

    public function update(Request $request, RoomRate $roomRate)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'rate_category_id' => 'required|exists:rate_categories,id',
            'rate' => 'required|numeric',
        ]);

        // Check if another RoomRate exists with the same room_type_id and rate_category_id
        $existingRate = RoomRate::where('room_type_id', $validated['room_type_id'])
            ->where('rate_category_id', $validated['rate_category_id'])
            ->where('id', '!=', $roomRate->id) // ignore current roomRate
            ->first();

        if ($existingRate) {
            return redirect()->back()->withErrors('Another Rate for this Room Type and Category already exists.');
        }

        $roomRate->update($validated);

        return redirect()->route('admin.rate.index')->with('success', 'Room rate updated successfully');
    }

//
//
//    public function update(Request $request, RoomRate $roomRate)
//    {
////        dd($request);
//        $validated = $request->validate([
//            'room_type_id' => 'required|exists:room_types,id',
//            'rate_category_id' => 'required|exists:rate_categories,id',
//            'rate' => 'required|numeric',
//        ]);
//
//        $roomRate->update($validated);
//
//        return redirect()->route('admin.rate.index')->with('success', 'Room rate updated successfully');
//
////        return response()->json(['message' => 'Room rate updated successfully', 'data' => $roomRate]);
//    }

    public function destroy(RoomRate $roomRate)
    {
//        dd($roomRate);
        $roomRate->delete();

        return redirect()->route('admin.rate.index')->with('success', 'Room rate deleted successfully');
    }
}
