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

Route::get('/tools/9', function() {
    $ID = 1;
    $info = "";
    if ($t = Tool::find($ID)) {
        $t->delete();
        if ($t->trashed()) $info .= 'usunięty mięciuteńko, ';
    } else {
        $info .= 'nie można odnaleźć wśród nieskasowanych (miękko skasowanych), ';
    }

    return $info;
});

Route::get('/tools/10', function() {
    $info = "";
    foreach (Tool::cursor() as $t) {
        $info .= $t->name."->";
    }
    Tool::chunk(4, function($pack) use (&$info) {
        $info .= "\nporcja: ";
        foreach ($pack as $t) {
            $info .= $t->description." ";
        }
    });

    return $info;
});

Route::get('/tools/11', function() {
    $t = Tool::find(22);

    return $t->repairs;
});

use App\Models\Repair;
Route::get('/tools/12', function() {
    $t = Repair::find(12);

    return $t->tool;
});

Route::get('/tools/13', function() {
    $t = Tool::find([1,2,3]);
    $t = Tool::where('name', 'Agnieszka')->firstOr(function(){ return "fail"; });
    $t = Tool::where('name', '>=', 'C');
    $count = Tool::where('name', 'Agnieszka')->count();

    return "przykłady";
});

use App\Models\ToolGroup;
Route::get('/tools/14', function() {
    $t = Tool::find(5);

    $t->toolgroups()->attach(1);
    $t->toolgroups()->attach([2,3]);

    return 'Success';
});

Route::get('/tools/15', function() {
    $t = Tool::find(5);

    $t->toolgroups()->detach(1);

    return 'Success';
});

Route::get('/tools/16', function() {
    $t = Tool::find(5);

    $t->toolgroups()->sync([3,4,5]);

    return 'Success';
});

Route::get('/tools/17', function() {
    $t = Tool::find(5);

    $t->toolgroups()->toggle([1,2,3]);

    return 'Success';
});

Route::get('/tools/18', function() {
    $t = Tool::find(5);

    $t->toolgroups()->syncWithoutDetaching([1,2,3]);

    return 'Success';
});

Route::get('/tools/19', function() {
    $t = Tool::find(10);
    $g = ToolGroup::find(5);
    $t->toolgroups()->save($g);
    $t->refresh();

    return 'Success';
});

Route::get('/tools/20', function() {
    $tg = ToolGroup::find(1);
    $tg->tools()->sync([3,4,5]);

    return 'Success';
});

Route::get('/tools/21', function() {
    $t = Tool::find(5);
    $t->toolgroups()->sync([3,4,5]);

    //return $t->toolgroups;
    return $t->toolgroups()->where('name', 'like', '%e')->get();
});

use App\Http\Controllers\SomeController;

Route::get('/controllers/1', [SomeController::class, 'optiona']);
Route::get('/controllers/2', [SomeController::class, 'optionb']);

use App\Http\Controllers\InvokableController;
Route::get('/controllers/3', InvokableController::class);

Route::get('/controllers/4', [SomeController::class, 'optionc']);

use App\Http\Controllers\ToolController;
Route::resource('srctools', ToolController::class);
