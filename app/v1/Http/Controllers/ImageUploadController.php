<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Максимальный размер 2MB для каждого файла
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $filePaths = [];

        // Обработка загрузки каждого файла
        $file = $request->file('image');
        // Генерация уникального имени для файла
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Сохранение файла в директорию
        $path = $file->storeAs('uploads', $fileName, 'public');
        $filePaths[] = 'http://127.0.0.1' . Storage::url($path); // Сохранение URL для возвращения


        // Возврат успешного ответа с массивом путей
        return response()->json([
            'message' => 'Upload successful',
            'paths' => $filePaths, // Возвращаем массив URL загруженных файлов
        ], 200);
    }

}
