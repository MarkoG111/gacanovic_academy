<?php

namespace App\Http\Services;

class Helper
{
    public static function returnGenericError()
    {
        return redirect()->back()->with('error', 'Error on server! Try again later.');
    }

    public static function returnGenericErrorAjax()
    {
        return response(['error' => 'Error on server, please try later.'], 500);
    }

    public static function getTime()
    {
        return date('Y-m-d H:i:s', time());
    }
}
