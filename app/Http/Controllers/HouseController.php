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

}
