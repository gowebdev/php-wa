<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;

class Status extends Response
{
    public function getLastState()
    {
        return $this->get('fileinfo.laststate');
    }
}