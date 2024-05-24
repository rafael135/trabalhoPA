<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/device", [DeviceController::class, "createDevice"])->withoutMiddleware(["auth:sanctum"])->name("api.createDevice");
Route::get("/device", [DeviceController::class, "getDevices"])->withoutMiddleware(["auth:sanctum"])->name("api.getDevices");
Route::get("/device/{id}", [DeviceController::class, "getDevice"])->withoutMiddleware(["auth:sanctum"])->name("api.getDevice");
Route::put("/device/{id}", [DeviceController::class, "updateDevice"])->withoutMiddleware(["auth:sanctum"])->name("api.updateDevice");
