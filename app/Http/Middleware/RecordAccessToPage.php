<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RecordAccessToPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $date = date('d-m-y H:i:s');

        if (session()->has('user')) {
            $writeIn = ($date . "\t" . $request->ip() . "\t" . 'Authorized: ' . session()->get('user')->email . "\t" . $request->url() . "\n");
            $openFile = fopen(storage_path() . '/app/file_access.txt', 'a');

            if ($openFile) {
                $date;
                fwrite($openFile, $writeIn);
                fclose($openFile);
            }
        } else {
            $writeIn = ($date . "\t" . $request->ip() . "\t" . 'Not Authorized: ' . "\t" . $request->url() . "\n");
            $openFile = fopen(storage_path() . '/app/file_access.txt', 'a');

            if ($openFile) {
                fwrite($openFile, $writeIn);
                fclose($openFile);
            }
        }

        return $next($request);
    }
}
