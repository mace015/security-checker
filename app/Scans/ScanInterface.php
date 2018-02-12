<?php

namespace App\Scans;

interface ScanInterface
{
    public function perform($console, $domain);
    public function getName();
    public function getStatus();
    public function getMessage();
    public function error($message);
    public function success($message);
}
