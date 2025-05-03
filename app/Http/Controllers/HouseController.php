<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HouseController extends Controller
{

    public function json_index(Request $request)
    {
        $search = $request->get('filter');

        $houseQuery = House::with(['roomTypes.roomRates.rateCategory']);

        if (!empty($search)) {
            $houseQuery->where('name', 'like', '%' . $search . '%');
        }

        $house = $houseQuery->first();

        // 👉 If no matching house found, get the first house
        if (!$house) {
            $house = House::with(['roomTypes.roomRates.rateCategory'])->first();
        }

        $rooms = collect();
        if ($house) {
            $rooms = $house->roomTypes->map(function ($roomType) {
                return [
                    'name' => $roomType->name,
                    'prices' => $roomType->roomRates->mapWithKeys(function ($roomRate) {
                        return [
                            $roomRate->rateCategory->name => '₹' . $roomRate->rate,
                        ];
                    }),
                ];
            });
        }

        $allHouse = House::all();

        return response()->json([
            'allHouseData' => $allHouse,
            'houseData' => $house,
            'roomsData' => $rooms,
        ]);
    }

    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $rowsPerPage = $request->get('rowsPerPage', 10);
        $page = $request->get('page', 1);

        $query = House::query()->orderBy('name');

        if ($filter) {
            $query->where('name', 'like', "%{$filter}%");
        }

        $list = $query->paginate($rowsPerPage, ['*'], 'page', $page);

        return response()->json([
            'list' => $list
        ]);
    }

    /**
     * Store a newly created house in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:houses,name',
        ]);

        $house = House::create([
            'name' => $request->name,
        ]);

        return redirect()->back();

    }

    /**
     * Update the specified house in storage.
     */
    public function update(Request $request, House $house)
    {

//        dd($house);
        $request->validate([
            'name' => 'required|string|max:255|unique:houses,name,' . $house->id,
        ]);

        $house->update([
            'name' => $request->name,
        ]);


        return redirect()->back();

    }

    /**
     * Remove the specified house from storage.
     */

    public function destroy(House $house)
    {
        // Check if the house has any associated room types
        if ($house->roomTypes()->count() > 0) {

            return redirect()->back()->withErrors(['error' => 'Cannot delete the house because it has associated room types.']);

        }

        // If no room types, check if any room types have associated room rates
        $hasRoomRates = $house->roomTypes()->whereHas('roomRates')->exists();

        if ($hasRoomRates) {

            return redirect()->back()->withErrors(['error' => 'Cannot delete the house because some room types have associated room rates.']);

        }

        // If no issues, delete the house
        $house->delete();

        // Return success response
        return redirect()->back();
    }



}
