<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get("/",[LoginController::class,"index"])->name("login.index");
Route::post("/login",[LoginController::class,"loginProcess"])->name("login.process");
Route::get("/logout",[LoginController::class,"destroy"])->name("login.destroy");

// Atualizar horário de acesso
Route::post('/update-last-active', [LoginController::class, 'updateLastActive']); 

Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');