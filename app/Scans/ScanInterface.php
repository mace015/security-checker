<?php

namespace App\Scans;

interface ScanInterface
{
    public function perform($console, $domain);
}
