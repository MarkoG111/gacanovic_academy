<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class Logs
{
    public static function logging($ex, $msg)
    {
        Log::channel('single')->error($msg . ', With a bug: ' . $ex);
    }

    public static function loggingSuccess($msg)
    {
        Log::channel('single')->notice($msg);
    }
}
