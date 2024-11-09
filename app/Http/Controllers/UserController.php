<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'desc')->get();

        return Inertia::render('User/Index', [
            'users' => UserResource::collection($data),
            'roles' => RoleResource::collection(Role::get()),
            'permissions' => PermissionResource::collection(Permission::get()),
            'countries' => Country::get(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $data->assignRole($request->roles);
        $data->countries()->attach($request->countries, []);

        return redirect()->route('users');
    }

    public function update(Request $request, User $user)
    {
        $pass = '';
        $request->password ? $pass = Hash::make($request->password) : $pass = $user->password;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
        ]);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->roles);

        return redirect()->route('users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}
