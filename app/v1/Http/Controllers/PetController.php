<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StorePetRequest;
use App\v1\Http\Requests\UpdatePetRequest;
use App\v1\Http\Resources\PetResource;
use App\v1\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetController
{
    public function index()
    {
        return PetResource::collection(
            Pet::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'about' => 'string|max:255',
            'user_id' => 'required',
            'type_id' => 'required',
            'sub_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $pet = Pet::create($validatedData);

        return response(new PetResource($pet), 201);
    }

    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'about' => 'string|max:255',
            'user_id' => 'required',
            'type_id' => 'required',
            'sub_type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $pet->update($validatedData);

        return new PetResource($pet);
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response('', 204);
    }
}
