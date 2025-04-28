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

        // Check if the house already has a room type with the same name
        $exists = $house->roomTypes()->where('name', $validated['name'])->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'This house already has a room type with the same name.']);

        }

        $house->roomTypes()->create($validated);

        return redirect()->back()->with('success', 'Room Type created successfully.');
    }

    // Update an existing RoomType
    public function update(Request $request, House $house, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if in the selected house, another room type with same name exists (except the current one)
        $exists = RoomType::where('house_id', $house->id)
            ->where('name', $validated['name'])
            ->where('id', '!=', $roomType->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'A room type with this name already exists in the selected house.']);
        }

        // Update both name and house_id (whether house is old or new)
        $roomType->update([
            'name' => $validated['name'],
            'house_id' => $house->id,
        ]);

        return redirect()->back()->with('success', 'Room Type updated successfully.');
    }

    // Delete a RoomType
    public function destroy(House $house, RoomType $roomType)
    {
//        dd($roomType);
        // Make sure the roomType belongs to the house
        if ($roomType->house_id !== $house->id) {
            return redirect()->back()->withErrors(['error' => 'This room type does not belong to the selected house.']);
        }
        // Optional: You can check if the roomType has related roomRates before deleting
        if ($roomType->roomRates()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Cannot delete room type with associated room rates.']);
        }
        $roomType->delete();

        return redirect()->back()->with('success', 'Room Type deleted successfully.');
    }

}
