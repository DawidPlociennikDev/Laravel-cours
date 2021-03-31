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

Route::get('/pokaz/sztucznych/ogni', function() {
    return '<span style="font-size: 24px; color: red;">Sztuczny</span> ogień<hr>';
});

$o = new StdClass();
$o->ufo=true;
Route::get('/dane', function() {
    ['punkty' => 'A,B,C'];
    ['który' => 'jest w przestrzeni', 'obiekt' => $o];
});

use App\Http\Controllers\FirstController;
Route::get('/dane3', [FirstController::class, 'smile']);

Route::redirect('/cel', 'pokaz/sztucznych/ogni', 301);

Route::view('forms', 'example', ['title' => 'Przykłady']);

use Illuminate\Http\Request;
Route::post('example/1', function(Request $r) {
    return $r->var;
});
Route::post('example/2', function(Request $r) {
    return $r->var;
});
Route::put('example/3', function(Request $r) {
    return $r->var;
});
Route::any('example/4', function(Request $r) {
    return $r->var;
});
Route::match(['post', 'patch'], 'example/5', function(Request $r) {
    return $r->var;
});

Route::get('example/nr/{n}', function ($n) {
    return 'example ' . $n;
});
Route::get('example/nr/{n}/{m}', function ($en, $em) {
    return 'example ' .  $en/$em;
});
Route::get('example/default/{x?}', function ($x=100) {
    return 'example ' . $x;
});

Route::get('example/count/{number}', function($n) {
    return 'example count = ' . $n;
});
Route::get('example/count_where/{number}', function($n) {
    return 'example count = ' . $n;
})->where('number', '[0-9]+');
Route::get('example/count_multi_where/{n}/{m}', function($n, $m) {
    return 'example count multi = ' . $n / $m;
})->where(['n' => '[0-9]+', 'm' => '-[1-9]{1}[0-9]*']);

Route::get('example/all/{id}', function($id) {
    return 'example id = ' . $id;
})->where('id', '.*');
Route::get('example/boot/{X}', function($X) {
    return 'example global X = ' . $X;
});
