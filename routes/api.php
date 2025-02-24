<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lightit\Backoffice\Employee\App\Controllers\ListEmployeesController;
use Lightit\Backoffice\Employee\App\Controllers\StoreEmployeeController;
use Lightit\Backoffice\Task\App\Controllers\GetTaskController;
use Lightit\Backoffice\Task\App\Controllers\ListTasksController;
use Lightit\Backoffice\Task\App\Controllers\UpsertTaskController;
use Lightit\Backoffice\Task\Domain\Actions\UpsertTaskAction;

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

/*
|--------------------------------------------------------------------------
| Employees Routes
|--------------------------------------------------------------------------
*/

Route::prefix('employees')
    ->group(static function () {
        Route::post('/', StoreEmployeeController::class)->name('employees');
        Route::get('/', ListEmployeesController::class)->name('employees');
    });

/*
|--------------------------------------------------------------------------
| Tasks Routes
|--------------------------------------------------------------------------
*/

Route::prefix('tasks')
    ->group(static function () {
        Route::post('/', UpsertTaskController::class)->name('tasks');
        Route::get('/', ListTasksController::class)->name('tasks');
        Route::get('/{task}', GetTaskController::class)->name('tasks');
    });
