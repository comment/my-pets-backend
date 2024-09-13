<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Role;

class RoleController
{
    public function index()
    {
        return RoleResource::collection(
            Role::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        return response(new RoleResource($role), 201);
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response('', 204);
    }
}
