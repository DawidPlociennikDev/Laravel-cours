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

Route::get('/collections/1', function() {
    $toolColl = App\Models\Tool::all();
    return $toolColl;
});

Route::get('/collections/2', function() {
    $toolColl = App\Models\Tool::all();
    $msg = [];
    foreach ($toolColl as $tool) {
        $msg[] = match($tool->description) {
            "MistyRose" => "Mi styro se gymro",
            "Ivory" => "I wory potwory",
            default => "b/d",
        };
    }
    return $msg;
});

Route::get('/collections/3', function() {
    $toolColl = App\Models\Tool::all();
    //return $toolColl->reject(fn($tool)=>$tool->description >= "K")->map(fn($tool)=>$tool->description);
    //return $toolColl->contains(2) . $toolColl->contains(App\Models\Tool::find(2)) .
    //(false===$toolColl->contains(1)) . (false===$toolColl->contains(App\Models\Tool::find(1)));

    $fi = App\Models\Tool::where("name", "<", "M")->get();
    $se = App\Models\Tool::where("name", ">", "g")->get();
    return $fi->diff($se)->map(fn($t)=>$t->name);
});

Route::get('/collections/4', function() {
    $fi = App\Models\Tool::where("name", "<", "Ż")->get()->map(fn($tool)=>$tool->name)->sort();
    //return $fi;

    $se = App\Models\Tool::where("name", ">=", "C")->get()->map(fn($tool)=>$tool->name)->sort();
    //return $se;

    //return $fi->concat($se)->sort();
    //return $fi->diff($se)->sort();
    //return $fi->intersect($se)->sort();

    $tools = App\Models\Tool::all();
    //return $tools->find(18)->name;
    //return $tools->except(18)->map(fn($t)=>$t->name)->sort();

    $tools->fresh();
    $tools->fresh('toolgroups');
    //return $tools->find(5)->toolgroups->map(fn($gr)=>$gr->name);

    //return $tools->modelKeys();
    //return $tools->average("broken");

    return $tools->whereBetween("name", ["A", "C"])->toJson();
});

use Illuminate\Http\Request;
Route::get('/cont/1', function(Request $req) {
    return $req->getClientIp();
});

use App\Goodluck;
Route::get('/cont/2', function() {
    $g = new Goodluck();
    return $g->darkMzimu();
});

Route::get('/cont/3', function(Goodluck $g) {
    return $g->darkMzimu();
});

Route::get('/cont/4', function() {
    $g1 = App::make(Goodluck::class);
    $g2 = App::make(Goodluck::class);
    $g3 = new Goodluck();
    return var_dump($g1, true) . " " . var_dump($g2, true) . " " . var_dump($g3, true);
});

use App\Badluck;
Route::get('/cont/5', function(Badluck $b1) {
    $b2 = App::make(Badluck::class);
    $b3 = new Badluck();
    return var_dump($b1, true) . " " .
            var_dump($b2, true) . " " .
            var_dump($b3, true) .
            $b1->brightMzimu() .
            $b2->brightMzimu() .
            $b3 ->brightMzimu() .
            $b1->getSecret() .
            $b2->getSecret() .
            $b3->getSecret();
});
