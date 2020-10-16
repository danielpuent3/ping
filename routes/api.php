<?php

use App\Http\Controllers\API\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::prefix('auth')->group(
    function () {
        Route::middleware('auth:sanctum')->get(
            '/',
            function (Request $request) {
                return $request->user();
            }
        )->name('api.auth.current');
        Route::post('/', [ApiAuthController::class, 'authenticate'])->name('api.auth.login');
        Route::post('/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
    }
);
