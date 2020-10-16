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

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::prefix('auth')->group(
    function () {
        Route::post('/', [ApiAuthController::class, 'authenticate'])->name('api.auth.login');
        Route::post('/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
    }
);
