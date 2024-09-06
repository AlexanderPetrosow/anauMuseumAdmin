<?php

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

// $2y$10$akzaD4uYShp4UknoM6qmXeAeAnGbG6/KQisnsmbHPOMh0WsGQPNgq

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
