<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;

class Remove extends Response
{
    const ERROR_INSUFFICIENT_ENVIRONMENT    = 7;
    
    public function getUrl()
    {
        return $this->get('remove.url');
    }
    
    public function isAlreadyRemovedError()
    {
        return $this->getStatus() === self::ERROR_INSUFFICIENT_ENVIRONMENT;
    }
}