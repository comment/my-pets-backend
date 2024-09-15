<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController
{
    public function index()
    {

    }

    public function store(StoreRoleRequest $request)
    {

    }

    public function show(Role $role)
    {

    }

    public function update(UpdateRoleRequest $request, Role $role)
    {

    }

    public function destroy(Role $role)
    {

    }

    public function upload(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Максимальный размер файла 2MB
        ]);

        $uploadedFiles = $request->file('image');
        $filePaths = [];

        foreach ($uploadedFiles as $file) {
            $path = $file->store('uploads', 'public');
            $filePaths[] = Storage::url($path);
        }

        return response()->json(['filePaths' => $filePaths], 200);
    }

}
