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
Route::post('example20', function(Request $request) {
    return "Przekazane w example20: {$request->name}.";
});

Route::post('example21', function(Request $request) {
    return "Przekazane w example21: {$request->name}.";
})->middleware('check');

Route::post('example22', function(Request $request) {
    return "Przekazane w example22: {$request->name}.";
})->middleware(App\Http\Middleware\CheckRequestExample::class);

Route::post('example23', function(Request $request) {
    return "Example23: {$request->name}.";
})->middleware('check:10,20');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
