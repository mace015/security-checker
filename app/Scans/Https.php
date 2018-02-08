<?php

namespace App\Scans;

use App\Scans\BaseScan;
use App\Scans\ScanInterface;

class Https extends BaseScan implements ScanInterface
{
    public function perform($console, $domain)
    {
        // Filter the protocol from the domain.
        $domain = str_replace(['http://', 'https://'], ['', ''], $domain);

        // Check if HTTP is not returning a 200 response.
        $http = exec('curl -s -I http://'. $domain .' | grep \'^HTTP\'');
        if (str_contains($http, '200')) {
            return $this->error('Domain serves over HTTP!');
        }

        // Check if HTTPS IS returning a 200 response.
        $http = exec('curl -s -I https://'. $domain .' | grep \'^HTTP\'');
        if (str_contains($http, '200')) {
            return $this->error('Domain does not serve over HTTPS!');
        }

        return $this->success('Domain only serves over HTTPS!');
    }
}
