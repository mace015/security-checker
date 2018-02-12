<?php

namespace App\Scans;

class BaseScan
{
    protected $status = null;
    protected $message = '';

    public function getName()
    {
        return $this->name;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getMessage()
    {
        return $this->message;
    }

    public function error($message)
    {
        $this->status = false;
        $this->message = $message;
        return;
    }

    public function success($message)
    {
        $this->status = true;
        $this->message = $message;
        return;
    }
}
