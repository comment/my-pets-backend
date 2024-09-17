<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Resources\UserResource;
use App\v1\Models\User;
use App\v1\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController
{
    public function index()
    {
        return UserResource::collection(
            User::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return response(new UserResource($user), 201);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();
        if(isset($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response('', 204);
    }
}
