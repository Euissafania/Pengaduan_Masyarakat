<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardMasyarakatController;
use App\Http\Controllers\Api\DataPengaduanController;
use App\Http\Controllers\Api\DataUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Authentication Token API
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// API Data User
Route::get('/dataUser', [DataUserController::class, 'index']);
Route::get('/dataUserId/{id}', [DataUserController::class, 'show']);
Route::post('/createDataUser', [DataUserController::class, 'create']);
Route::post('/updateDataUser/{id}', [DataUserController::class, 'update']);

// API Data Pengaduan
Route::get('/Data-Pengaduan', [DataPengaduanController::class, 'index']);
Route::get('/Data-Pengaduan/{id}', [DataPengaduanController::class, 'show']);
Route::delete('/Data-Pengaduan/{id}', [DataPengaduanController::class, 'destroy']);
Route::post('/Data-Pengaduan', [DataPengaduanController::class, 'create']);
Route::put('/Data-Pengaduan/{id}', [DataPengaduanController::class, 'update']);

//REST API MASYARAKAT
Route::get('/masyarakat',[DashboardMasyarakatController::class,'index']);
Route::get('/masyarakat/{id}',[DashboardMasyarakatController::class,'show']);
Route::post('/masyarakat-create',[DashboardMasyarakatController::class,'store']);
Route::put('/masyarakat/{id}',[DashboardMasyarakatController::class,'update']);
Route::delete('/masyarakat/{id}',[DashboardMasyarakatController::class,'destroy']);