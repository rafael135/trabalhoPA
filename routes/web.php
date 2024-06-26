<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DeviceController;
use App\Http\controllers\SobreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth"])->group(function() {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/eletronicos", [DeviceController::class, "index"])->name("eletronicos");
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::get("/contato", [ContatoController::class, "index"])->name("contato");
Route::get("/sobre", [SobreController::class, "index"])->name("sobre");

Route::get("/register", [AuthController::class, "registerView"])->name("register");
Route::post("/register", [AuthController::class, "registerAction"])->name("registerAction");

Route::get("/login", [AuthController::class, "loginView"])->name("login");
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
