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
use Illuminate\Validation\Rule;
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
                        ->orWhere('mobile', 'like', "%{$search}%")
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
//        $user = auth()->user();
//        abort_if(!$user->hasPermissionTo('edit-user'),403,'Access Denied');
        $data=$this->validate($request, [
            'name'=>'required',
            'mobile'=>'required|digits:10|unique:users',
            'email'=>'required|email|unique:users',
//            'password'=>'required|confirmed',
            'password'=>'required',
            'house_id'=>'nullable|exists:houses,id',
        ]);

        $roles = $request->get('role');
//        $mergedData = array_merge($data, ['password' => Hash::make(Str::random(12))]);
        DB::transaction(function () use ($roles, $request, $data) {
            $user=User::query()->create($data);
            if ($roles) {
                $user->assignRole($roles);
            }
        });
        return to_route('admin.users.index');
    }
    public function update(Request $request, User $model)
    {
//        $user = auth()->user();
//        abort_if(!$user->hasPermissionTo('edit-user'),403,'Access Denied');
//        dd($request->all());
        $data=$this->validate($request, [
            'name'=>'required',
            'mobile'=>['required','digits:10',Rule::unique('users','mobile')->ignore($model->id)],
            'email'=>['required','email',Rule::unique('users','email')->ignore($model->id)],
            'house_id'=>'nullable|exists:houses,id',
        ]);
        $roles = $request->get('role');
        $password = $request->get('password');
        DB::transaction(function () use ($model, $password, $roles, $request, $data) {
            $model->update($data);
            if ($roles) {
                $model->assignRole($roles);

            }
            if ($password) {
                $model->password = Hash::make($password);
                $model->save();
            }

        });

        return to_route('admin.users.index');
    }

    public function destroy(Request $request,User $model)
    {
//        $user = auth()->user();
//        abort_if(!$user->hasPermissionTo('delete-user'),403,'Access Denied');

//        dd($request);
        $model->delete();

        return to_route('admin.users.index');
    }


}
