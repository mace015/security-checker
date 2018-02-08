<?php

namespace App\Scans;

use App\Scans\BaseScan;
use App\Scans\ScanInterface;

class HstsHeader extends BaseScan implements ScanInterface
{
    public function perform($console, $domain)
    {
        // Filter the protocol from the domain.
        $domain = str_replace(['http://', 'https://'], ['', ''], $domain);
        
        $hsts = exec('curl -s -I https://'. $domain .' | grep \'^Strict\'');
        if (!str_contains($hsts, 'Strict-Transport-Security')) {
            return $this->error('HSTS header not set!');
        }

        return $this->success('HSTS header set!');
    }
}
