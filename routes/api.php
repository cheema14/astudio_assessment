<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/get-all-attributes', [AttributeController::class, 'getAllAttributes'])->name('getAllAttributes');
    Route::post('/store-attributes', [AttributeController::class, 'storeAttribute'])->name('storeAttribute');

    Route::post('/projects/{id}/attributes', [AttributeValueController::class, 'storeAttributeValue'])->name('storeAttributeValue');
    // Route::get('/projects/{id}', [AttributeValueController::class, 'showAll'])->name('showAllAttributeValues');
    Route::get('/projects/filter', [AttributeValueController::class, 'filterAttributes'])->name('filterAttributeValues');

    Route::post('/save-project', [ProjectController::class, 'saveProject'])->name('saveProject');
    Route::put('update-project/{id}', [ProjectController::class, 'updateProject'])->name('updateProject');
    Route::delete('delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');
    Route::get('/get-project/{id}', [ProjectController::class, 'getProject'])->name('getProject');
    Route::get('/get-all-projects', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');

    Route::get('/projects/filter-projects', [AttributeValueController::class, 'filterAttributes'])->name('filterAttributes');

    Route::resource('users', UserController::class);
});

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');
