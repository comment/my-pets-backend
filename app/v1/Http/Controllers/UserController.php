<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Resources\UserResource;
use App\v1\Models\User;
use App\v1\Http\Requests\StoreUserRequest;
use App\v1\Http\Requests\UpdateUserRequest;

class UserController
{
    public function index()
    {
        return UserResource::collection(
            User::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response(new UserResource($user), 201);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response('', 204);
    }
}
