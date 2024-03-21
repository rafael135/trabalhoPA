<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, "index"]);

Route::get("/register", [AuthController::class, "registerView"])->name("registerView");
Route::post("/register", [AuthController::class, "registerAction"])->name("registerAction");

Route::get("/login", [AuthController::class, "loginView"])->name("loginView");
Route::post("/login", [AuthController::class, "loginAction"])->name("loginAction");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

//require __DIR__.'/auth.php';
