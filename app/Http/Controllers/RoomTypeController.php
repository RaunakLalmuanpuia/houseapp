<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    // Show all RoomTypes for a House
//    public function index(House $house)
//    {
//        $roomTypes = $house->roomTypes()->latest()->get();
//
//        return Inertia::render('RoomType/Index', [
//            'house' => $house,
//            'roomTypes' => $roomTypes,
//        ]);
//    }

    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $rowsPerPage = $request->get('rowsPerPage', 10);
        $page = $request->get('page', 1);

        $query = RoomType::query()
            ->with('house'); // Eager load house relation

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter}%") // Search room type name
                ->orWhereHas('house', function ($q2) use ($filter) {
                    $q2->where('name', 'like', "%{$filter}%"); // Search house name
                });
            });
        }

        $list = $query->orderBy('name')
            ->paginate($rowsPerPage, ['*'], 'page', $page);

        $house = House::all();
        return response()->json([
            'list' => $list,
            'house' => $house
        ]);
    }

    // Store a new RoomType
    public function store(Request $request, House $house)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $house->roomTypes()->create($validated);
        return redirect()->back();

//        return redirect()->back()->with('success', 'Room Type created successfully.');
    }

    // Update an existing RoomType
    public function update(Request $request, House $house, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($roomType->house_id !== $house->id) {
            return redirect()->back()->withErrors('This room type does not belong to the selected house.');
        }

        $roomType->update($validated);

        return redirect()->back()->with('success', 'Room Type updated successfully.');
    }

    // Delete a RoomType
    public function destroy(House $house, RoomType $roomType)
    {
        if ($roomType->house_id !== $house->id) {
            return redirect()->back()->withErrors('This room type does not belong to the selected house.');
        }

        $roomType->delete();

        return redirect()->back()->with('success', 'Room Type deleted successfully.');
    }
}
