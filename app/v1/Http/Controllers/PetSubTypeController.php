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

class PetSubTypeController
{
    public function index()
    {
        return PetSubTypeResource::collection(
            PetSubType::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(StorePetSubTypeRequest $request)
    {
        $data = $request->validated();
        $pet = PetSubType::create($data);
        return response(new PetSubTypeResource($pet), 201);
    }

    public function show(PetSubType $pet_sub_type)
    {
        return new PetSubTypeResource($pet_sub_type);
    }

    public function update(UpdatePetSubTypeRequest $request, PetSubType $pet_sub_type)
    {
        $data = $request->validated();
        $pet_sub_type->update($data);
        return new PetSubTypeResource($pet_sub_type);
    }

    public function destroy(PetSubType $pet_sub_type)
    {
        $pet_sub_type->delete();

        return response('', 204);
    }
}
