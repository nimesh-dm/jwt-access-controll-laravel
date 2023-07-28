<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

//common auth apis------------------------------------------------------------
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    

});

//admin apis------------------------------------------------------------
Route::middleware(['auth:api', 'role:admin'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/user', 'user');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::post('/role/new', 'create');
        Route::post('/user/role', 'setUserRole');
        Route::post('/role/list', 'getRoles');
    });
    
});
