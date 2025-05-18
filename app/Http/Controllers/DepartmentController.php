<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $rowsPerPage = $request->get('rowsPerPage', 10);
        $page = $request->get('page', 1);

        $query = Department::query()->orderBy('name');


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
//        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:houses,name',
        ]);

        $department = Department::create([
            'name' => $request->name,
        ]);

        return redirect()->back();

    }

    /**
     * Update the specified house in storage.
     */
    public function update(Request $request, Department $department)
    {

//        dd($house);
        $request->validate([
            'name' => 'required|string|max:255|unique:houses,name,' . $department->id,
        ]);

        $department->update([
            'name' => $request->name,
        ]);


        return redirect()->back();

    }

    /**
     * Remove the specified house from storage.
     */

    public function destroy(Department $department)
    {
        if ($department->applications()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Cannot delete Department because it has Application assosiated with it.']);
        }
        // If no issues, delete the house
        $department->delete();

        // Return success response
        return redirect()->back();
    }
}
