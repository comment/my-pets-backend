<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StorePetRequest;
use App\v1\Http\Requests\StorePetSubTypeRequest;
use App\v1\Http\Requests\UpdatePetRequest;
use App\v1\Http\Requests\UpdatePetSubTypeRequest;
use App\v1\Http\Requests\UpdatePetTypeRequest;
use App\v1\Http\Resources\PetResource;
use App\v1\Http\Resources\PetSubTypeResource;
use App\v1\Http\Resources\PetTypeResource;
use App\v1\Models\Pet;
use App\v1\Models\PetSubType;
use App\v1\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetSubTypeController
{
    public function index()
    {
        return PetSubTypeResource::collection(
            PetSubType::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $request->validated();

        $pet = PetSubType::create($validatedData);

        return response(new PetSubTypeResource($pet), 201);
    }



    public function show(PetSubType $pet_sub_type)
    {
        return new PetSubTypeResource($pet_sub_type);
    }

    public function update(Request $request, PetSubType $pet_sub_type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $request->validated();

        $pet_sub_type->update($validatedData);

        return new PetSubTypeResource($pet_sub_type);
    }

    public function destroy(PetSubType $pet_sub_type)
    {
        $pet_sub_type->delete();

        return response('', 204);
    }
}
