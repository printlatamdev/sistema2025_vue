<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::orderBy('id', 'desc')->get();

        return Inertia::render('Role/Index', [
            'roles' => RoleResource::collection($data),
        ]);
    }

    public function store(Request $request)
    {
        $data = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
        $data->syncPermissions($permissions);

        return redirect()->route('users');
    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);

        return redirect()->route('users');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('users');
    }
}
