<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StorePetRequest;
use App\v1\Http\Requests\StorePetTypeRequest;
use App\v1\Http\Requests\UpdatePetRequest;
use App\v1\Http\Requests\UpdatePetTypeRequest;
use App\v1\Http\Resources\PetResource;
use App\v1\Http\Resources\PetTypeResource;
use App\v1\Models\Pet;
use App\v1\Models\PetType;
use Illuminate\Http\Request;

class PetTypeController
{
    public function index()
    {
        return PetTypeResource::collection(
            PetType::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(StorePetTypeRequest $request)
    {
        $data = $request->validated();
        $pet = PetType::create($data);
        return response(new PetTypeResource($pet), 201);
    }

    public function show(PetType $pet_type)
    {
        return new PetTypeResource($pet_type);
    }

    public function update(UpdatePetTypeRequest $request, PetType $pet_type)
    {
        $data = $request->validated();
        $pet_type->update($data);
        return new PetTypeResource($pet_type);
    }

    public function destroy(PetType $pet_type)
    {
        $pet_type->delete();

        return response('', 204);
    }
}
