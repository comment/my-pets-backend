<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreImageRequest;
use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Image;
use App\v1\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ImageController
{
    public function index()
    {

    }

    public function store(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();
        $file = $validatedData['image'];

        $fileName = time() . '_' . $file->getClientOriginalName(); //todo добавить уникальный файлнейм без исходного
        $path = $file->storeAs('uploads', $fileName, 'public');

        $filePaths[] = 'http://127.0.0.1' . Storage::url($path); //todo добавить переменную для УРЛ

        return response()->json([
            'paths' => $filePaths,
        ], 201);
    }

    public function show(Image $image)
    {
        //return new PetResource(Image);
    }

    public function update(Request $request, Image $image)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $image->update($validatedData);

        //return new UserResource($image);
    }

    public function destroy(Image $image)
    {
        $pet->delete();

        return response('', 204);
    }

}
