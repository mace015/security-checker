<?php

namespace App\Scans;

class Https extends BaseScan implements ScanInterface
{
    protected $name = 'HTTPS only';
    
    public function perform($console, $domain)
    {
        // Filter the protocol from the domain.
        $domain = str_replace(['http://', 'https://'], ['', ''], $domain);

        // Check if HTTP is not returning a 200 response.
        $http = exec('curl -s -I http://'. $domain .' | grep \'^HTTP\'');
        if (str_contains($http, '200')) {
            $this->error('Domain serves over HTTP!');
            return $this;
        }

        // Check if HTTPS IS returning a 200 response.
        $http = exec('curl -s -I https://'. $domain .' | grep \'^HTTP\'');
        if (str_contains($http, '200')) {
            $this->error('Domain does not serve over HTTPS!');
            return $this;
        }

        $this->success('Domain only serves over HTTPS!');
        return $this;
    }
}
