<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// Public routes of authtication

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});


Route::group(['middleware' => ['auth:api', 'checkGroupName']], function () {

    Route::post('/groupes/ajouter', [GroupeController::class, 'ajouter']);

    Route::put('/groupes/{id}/update', [GroupeController::class, 'update']);

    Route::delete('/groupes/{id}/delete', [GroupeController::class, 'delete']);

    Route::put('/groupes/{groupId}/utilisateurs/{userId}/assigner', [GroupeController::class, 'assignUserToGroup']);


    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::get('/permissions/{id}', [PermissionController::class, 'show']);
    Route::put('/permissions/{id}', [PermissionController::class, 'update']);
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);

    Route::put('/groups/{groupId}/permissions/{permId}', [PermissionController::class, 'assignPermissionToGroup']);

    /*la gestion des user */

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

});


Route::delete('/logout', [LoginRegisterController::class, 'logout'])->middleware('auth:api');




