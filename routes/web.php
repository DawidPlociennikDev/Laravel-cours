<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FirstController;
Route::get('/request/example1/{x}/{y}', [FirstController::class, 'ReqRes1']);
Route::get('/request/example2/{x}/{y}', [FirstController::class, 'ReqRes2']);
Route::get('/request/example3/{x}/{y}', [FirstController::class, 'ReqRes3']);
