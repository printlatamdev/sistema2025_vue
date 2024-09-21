<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'desc')->get();

        return UserResource::collection($data);
    }

    public function store(StoreUserRequest $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $data->assignRole($request->roles);

        return redirect()->route('users');
    }

    public function update(Request $request, User $user)
    {
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
