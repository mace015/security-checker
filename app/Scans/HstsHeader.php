<?php

namespace App\Scans;

class HstsHeader extends BaseScan implements ScanInterface
{
    protected $name = 'HSTS header';

    public function perform($console, $domain)
    {
        // Filter the protocol from the domain.
        $domain = str_replace(['http://', 'https://'], ['', ''], $domain);
        
        $hsts = exec('curl -s -I https://'. $domain .' | grep \'^Strict\'');
        if (!str_contains($hsts, 'Strict-Transport-Security')) {
            $this->error('HSTS header not set!');
            return $this;
        }

        $this->success('HSTS header set!');
        return $this;
    }
}
