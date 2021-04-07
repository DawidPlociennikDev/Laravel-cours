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

Route::get('example5/a/b/{c}', function($c) {
    return 'ni' . $c . ' ' . $c . 'iekawego, ale...';
})->name('exe5');
Route::get('example6', function() {
    return redirect()->route('exe5', ['c' => 'cz']);
});
Route::middleware(['cudownie'])->group(function() {
    Route::get('example7/{date}', function($date) {
        return 'Litości. Fakt to nie pogląd! Potwierdzone dnia: ' . $date;
    })->name('fakt');
});
Route::prefix('jestem/prefixem')->group(function() {
    Route::get('example8', function() {
        return 'Suchar: Jak nazywa się połączenie papugi i krokodyla kapitana Haka: Polityka.';
    });
});
Route::name('Poli.')->group(function() {
    Route::get('example9', function() {
        return 'Czosnek w miodzie z majonezem.';
    })->name('tyka');
    Route::get('example10', function() {
        return 'Otręby z cementem smaku nie zmienią';
    })->name('morfizm');
});
Route::middleware('throttle:2,1')->group(function() {
    Route::get('example11', function() {
        return 'Nie tak prędko!';
    });
});

