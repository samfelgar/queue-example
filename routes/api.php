<?php

use App\Http\Controllers\QueueController;
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

Route::get('/dispatch', [QueueController::class, 'push']);

Route::get('/dispatch/raw', [QueueController::class, 'pushRaw']);

Route::get('/pop', [QueueController::class, 'pop']);
