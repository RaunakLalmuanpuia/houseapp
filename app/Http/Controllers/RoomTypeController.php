<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    // Show all RoomTypes for a House
    public function index(House $house)
    {
        $roomTypes = $house->roomTypes()->latest()->get();

        return Inertia::render('RoomType/Index', [
            'house' => $house,
            'roomTypes' => $roomTypes,
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
