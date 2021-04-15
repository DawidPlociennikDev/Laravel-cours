<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function ReqRes1(Request $r, $x, $y, ABC $abc=null) {
        if (is_null($abc))$abc=new ABC(10);
        return [
            "x" => $x,
            "y" => $y,
            '$r->path()' => $r->path(),
            '$r hashid ' => spl_object_hash($r) . " " . spl_object_id($r),
                '$abc object id' => spl_object_id($abc),
                '$abc->x' => $abc->x,
            '$ReqRes2' => $this->ReqRes2($x, $r, $y)
        ];
    }

    public function ReqRes2($x, Request $r, $y) {
        return [$x,$y,$r->path(),spl_object_hash($r),spl_object_id($r)];
    }

    public function ReqRes3($x,$r,$y) {
        return [$x,$y,$r->path(),spl_object_hash($r),spl_object_id($r)];
    }

    public function ReqRes4(Request $r,$x,$y) {
        return [
            'dane' => $r->all(),
            'input' => [$r->input('instytucja'), $r->input('tablica.0'), $r->wiadomość],
            'url' => [$r->url(), $r->fullUrl()],
            'dopasowanie' => [$r->is('*request/example*'), $r->is('*kasza*')],
            'metoda' => [$r->method(), $r->isMethod('get')],
            'boolean' => [$r->input('prawda'), $r->boolean('prawda.0'),
                $r->boolean('prawda.1'), $r->boolean('prawda.2'), $r->boolean('prawda.3')],
            'tests' => [$r->has('prawda'), $r->has(['prawda', 'wiadomość']), $r->hasAny(['niema', 'prawda']),
                $r->filled('prawda'), $r->filled('pusto')],
            'flash' => $r->old('instytucja'),
        ];
    }

    public function ReqRes5example(Request $r, $x, $y) {
        $r->flash();
        $r->old('dane');
        return redirect('formularz')->whitinput();
    }

    public function ReqRes6(Request $r, $x, $y) {
        //return response()->json(['name' => 'Bergunda', 'lastname' => 'Glonnenburg']);
        //return response("$x/$y", 200)->header('Content-type', 'text/plain')->cookie('kwiat', 'tulipan');
        return response("$x/$y", 400)->withHeaders([
            'Content-type' => 'text/plain',
            'Server' => 'Relax and Creepy',
        ]);
        return redirect()->route('nazwa trasy');
        return redirect()->action('Kontroller@metoda', ['parametry'=>10]);
        return redirect()->away('http://webjasiek.pl');
    }
}
