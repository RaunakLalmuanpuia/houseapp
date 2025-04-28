<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\RateCategory;
class RateCategoryController extends Controller
{
    //
    public function index(Request $request)
    {

        $filter = $request->get('filter');
        $rowsPerPage = $request->get('rowsPerPage', 10);
        $page = $request->get('page', 1);

        $query = RateCategory::query()->orderBy('name');

        if ($filter) {
            $query->where('name', 'like', "%{$filter}%");
        }

        $list = $query->paginate($rowsPerPage, ['*'], 'page', $page);

        return response()->json([
            'list' => $list
        ]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255|unique:rate_categories,name',
        ]);

        // Create new RateCategory
        $rateCategory = RateCategory::create($request->only('name'));

        // Return response
        return redirect()->back();  // Return newly created rate category with status 201.
    }


    public function update(Request $request, RateCategory $rateCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rate_categories,name,' . $rateCategory->id,
        ]);

        // Update the rate category
        $rateCategory->update($request->only('name'));

        // Return response
        return redirect()->back();
    }

    public function destroy(RateCategory $rateCategory)
    {
        // Check if the rate category has associated room rates
        if ($rateCategory->roomRates()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Cannot delete, there are room rates associated with this category.']);
        }
        // Delete the rate category
        $rateCategory->delete();
        // Return response
        return redirect()->back();

    }



}
