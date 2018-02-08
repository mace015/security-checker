<?php

namespace App\Scans;

class BaseScan
{
    public function error($message)
    {
        return [false, $message];
    }

    public function success($message)
    {
        return [true, $message];
    }
}
