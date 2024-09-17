<?php

namespace App\v1\Http\Controllers;

use App\v1\Http\Requests\StoreImageRequest;
use App\v1\Http\Requests\StoreRoleRequest;
use App\v1\Http\Requests\UpdateRoleRequest;
use App\v1\Http\Resources\RoleResource;
use App\v1\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController
{
    public function index()
    {

    }

    public function store(Request $request): JsonResponse
    {
        $filePaths = [];

        // Обработка загрузки каждого файла
        $file = $request->file('image');
        // Генерация уникального имени для файла
        $fileName = time() . '_' . $file->getClientOriginalName(); //todo добавить уникальный файлнейм без исходного

        // Сохранение файла в директорию
        $path = $file->storeAs('uploads', $fileName, 'public');
        $filePaths[] = 'http://127.0.0.1' . Storage::url($path); //todo добавить переменную для УРЛ


        // Возврат успешного ответа с массивом путей
        return response()->json([
            'message' => 'Upload successful',
            'paths' => $filePaths,
        ], 200);
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

}
