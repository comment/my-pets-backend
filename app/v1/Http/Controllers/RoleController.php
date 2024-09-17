<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController
{
    public function index()
    {
        return RoleResource::collection(
            Role::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $request->validated();

        $role = Role::create($validatedData);

        return response(new RoleResource($role), 201);
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $request->validated();

        $role->update($validatedData);

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response('', 204);
    }
}
