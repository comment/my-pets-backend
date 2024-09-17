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

        $image = new Image();
        $image->image_type = 2;//pets
        $image->filename = $fileName;
        $image->mime_type = 'jpg';
        $image->size = '123213';
        $image->path = 'http://127.0.0.1' . Storage::url($path);
        $image->user_id = '9d089414-b624-40ce-a73f-ee0cc9c87759';
        $image->pet_id = '9d089414-eb1d-406f-b632-d9f34ab446d1';
        $image->save();


        return response()->json([
            'image' => $image,
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
        $image->delete();

        return response('', 204);
    }

}
