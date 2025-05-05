<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RateCategory;
use App\Models\RoomRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index(Request $request){

        $search = $request->input('search');
        $perPage = $request->get('perPage', 10);

        // Fetch all Houses with their Room Types
        $houses = House::with('roomTypes')->get();

        $userRoles=Role::query()->get(['name as value','name as label']);

//        dd($roles);
        $users = User::with(['house', 'roles'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('house', function ($houseQuery) use ($search) {
                            $houseQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('roles', function ($roleQuery) use ($search) {
                            $roleQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->paginate($perPage);
//        dd($users);

        return Inertia::render('User/Index', [
            'houses' => $houses,
            'users' => $users,
            'userRoles' => $userRoles,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function store(Request $request)
    {

//        dd($request);

        $data=$this->validate($request, [
            'name'=>'required',
            'mobile'=>'nullable|digits:10|unique:users',
            'email'=>'required|email|unique:users',
//            'password'=>'required|confirmed',
            'password'=>'required',
            'house_id'=>'nullable|exists:houses,id',
        ]);
        $roles = $request->get('role');
        $mergedData = array_merge($data, ['password' => Hash::make(Str::random(12))]);
        DB::transaction(function () use ($roles, $request, $mergedData) {
            $user=User::query()->create($mergedData);
            if ($roles) {
                $user->assignRole($roles);
            }
        });

        return to_route('admin.users.index');
    }

}
