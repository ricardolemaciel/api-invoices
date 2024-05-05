<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/users',[UserController::class,'index']);
    Route::get('/users/{user}',[UserController::class,'show']);
    Route::apiResource('invoices',InvoiceController::class);
    Route::delete('/logout', [AuthController::class,'destroy']);

});
Route::post('/v1/login', [AuthController::class,'store']);

// 2|meJd3xk4Ke8IEfPw2bGInKNtJkbUC6Hry4SxdnDI98ba6100
