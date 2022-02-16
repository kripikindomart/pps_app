<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\DepartementController;
use App\Http\Controllers\API\KaryawanController;
use App\Http\Controllers\API\PejabatController;
use App\Http\Controllers\API\ProgramStudiController;
use App\Http\Controllers\API\StudentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    

    //Permission Setting
    Route::get('user-authenticated', [App\Http\Controllers\API\UserController::class, 'getUserLogin'])->name('user.authenticated');
    Route::get('user-lists', [App\Http\Controllers\API\UserController::class, 'userLists'])->name('user.index');
    Route::get('roles', [App\Http\Controllers\API\RolePermissionController::class, 'getAllRole'])->name('roles');
    Route::get('permissions', [App\Http\Controllers\API\RolePermissionController::class, 'getAllPermission'])->name('permission');
    Route::post('role-permission', [App\Http\Controllers\API\RolePermissionController::class, 'getRolePermission'])->name('role_permission');
    Route::post('set-role-permission', [App\Http\Controllers\API\RolePermissionController::class, 'setRolePermission'])->name('set_role_permission');
    Route::post('set-role-user', [App\Http\Controllers\API\RolePermissionController::class, 'setRoleUser'])->name('user.set_role');
});
