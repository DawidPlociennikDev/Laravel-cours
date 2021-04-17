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

use App\Models\Tool;
Route::get('/tools/1', function() {
    $t = new Tool;
    $t->name = 'młotek';
    $t->description = 'młotek ze stali chińskiej';
    $t->counter = 2;
    $t->save();
    return "Ok";
});

Route::get('/tools/2', function() {
    $t = Tool::create([
        'name' => 'klucz 10mm',
        'description' => 'klucz luzem, bez zestawu',
        'counter' => 4
    ]);

    return 'Ok';
});

Route::get('/tools/3', function() {
    $t = Tool::first();
    $t->name = 'młotek klasyczny';
    $t->save();

    return 'Ok';
});

Route::get('/tools/4', function() {
    \App\Models\Tool::factory()->count(10)->create();

    return 'Ok';
});

Route::get('/tools/5', function() {
    $all = Tool::all();

    return $all;
});

Route::get('/tools/6', function() {
    $all = Tool::where('broken', false)->orderBy('name', 'asc')->get();
    $names = [];
    foreach ($all as $t) {
        $names[] = $t->name;
    }

    return $names;
});

Route::get('/tools/7', function() {
    $all = Tool::all()->filter(fn($e)=>$e->name<'M')->sortBy('name');
    $names = [];
    foreach ($all as $t) {
        $names[] = $t->name;
    }

    return $names;
});

Route::get('/tools/8', function() {
    $ID = 5;

    $t = Tool::destroy($ID);

    return 'Success';
});


