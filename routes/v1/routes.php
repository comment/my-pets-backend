<?php

use Illuminate\Support\Facades\Route;

Route::prefix('sanctum')->as('sanctum:')->group(
    base_path('routes/v1/auth.php'),
);

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
