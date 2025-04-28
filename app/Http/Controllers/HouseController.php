<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HouseController extends Controller
{
    public function index(Request $request)
    {


        $search = $request->get('search');

        $houseQuery = House::with(['roomTypes.roomRates.rateCategory']);

        if (!empty($search)) {
            $houseQuery->where('name', 'like', '%' . $search . '%');
        }

        $house = $houseQuery->first();

        if (!$house) {
            return Inertia::render('House/Index', [
                'rooms' => [],
            ]);
        }

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

        $allHouse = House::all();
        return Inertia::render('House/Index', [
            'allHouse' => $allHouse,
            'house' => $house,
            'rooms' => $rooms,
            'search' => $search,
        ]);
    }


    public function house_index(Request $request)
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

//        return response()->json([
//            'success' => true,
//            'message' => 'House created successfully',
//            'data' => $house
//        ]);
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
//        return response()->json([
//            'success' => true,
//            'message' => 'House updated successfully',
//            'data' => $house
//        ]);
    }

    /**
     * Remove the specified house from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();

        return redirect()->back();

//        return response()->json([
//            'success' => true,
//            'message' => 'House deleted successfully'
//        ]);
    }

}
