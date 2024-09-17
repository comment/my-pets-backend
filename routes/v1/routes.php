<?php

use App\v1\Http\Controllers\ImageController;
use App\v1\Http\Controllers\PetController;
use App\v1\Http\Controllers\PetSubTypeController;
use App\v1\Http\Controllers\PetTypeController;
use App\v1\Http\Controllers\RoleController;
use App\v1\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('sanctum')->as('sanctum:')->group(
    base_path('routes/v1/auth.php'),
);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('/users',UserController::class);

    Route::apiResource('/pets',PetController::class);

    Route::apiResource('/roles',RoleController::class);

    Route::apiResource('/pet_types',PetTypeController::class);
    Route::get('/get_sub_types/{type_id}', [PetTypeController::class, 'get_sub_types']);

    Route::apiResource('/pet_sub_types',PetSubTypeController::class);

    Route::apiResource('/images', ImageController::class);
});

Route::get('/unauthenticated', function () {
    return response()->json(
        [
            'errors' => [
                'status' => 401,
                'message' => 'Unauthenticated',
            ]
        ],
        401
    );
});
