<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StorePetRequest;
use App\v1\Http\Requests\StorePetTypeRequest;
use App\v1\Http\Requests\UpdatePetRequest;
use App\v1\Http\Requests\UpdatePetTypeRequest;
use App\v1\Http\Resources\PetResource;
use App\v1\Http\Resources\PetSubTypeResource;
use App\v1\Http\Resources\PetTypeResource;
use App\v1\Models\Pet;
use App\v1\Models\PetSubType;
use App\v1\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetTypeController
{
    public function index()
    {
        return PetTypeResource::collection(
            PetType::query()->orderBy('id', 'desc')->get()
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

        $pet = PetType::create($validatedData);

        return response(new PetTypeResource($pet), 201);
    }

    public function show(PetType $pet_type)
    {
        return new PetTypeResource($pet_type);
    }

    public function update(Request $request, PetType $pet_type)
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

        $pet_type->update($validatedData);

        return new PetTypeResource($pet_type);
    }

    public function destroy(PetType $pet_type)
    {
        $pet_type->delete();

        return response('', 204);
    }

    public function get_sub_types($pet_type)
    {
        return PetTypeResource::collection(
            PetSubType::where('type_id', $pet_type)->get()
        );
    }
}
