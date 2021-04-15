<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRequestExample
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$args)
    {
        $request->name = "Janko";
        $request->name .= " meduzy kant";

        foreach ($args as $a) {
            $request->name .= "\n {$a}";
        }

        return $next($request);
    }

    public function terminate($request, $response) {
        file_put_contents('plik_po.txt', $request->name);
    }
}
