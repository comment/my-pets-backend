<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StorePetRequest;
use App\v1\Http\Requests\UpdatePetRequest;
use App\v1\Http\Resources\PetResource;
use App\v1\Models\Pet;
use Illuminate\Http\Request;

class PetController
{
    public function index()
    {
        return PetResource::collection(
            Pet::query()->orderBy('id', 'desc')->get()
        );
    }

    public function store(StorePetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user_id;
        $data['type_id'] = $request->type_id;
        $data['sub_type_id'] = $request->sub_type_id;
        $pet = Pet::create($data);
        return response(new PetResource($pet), 201);
    }

    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $data = $request->validated();
        $pet->update($data);
        return new PetResource($pet);
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response('', 204);
    }
}
