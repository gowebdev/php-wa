<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;

class Confirm extends Response
{
    public function getUrl()
    {
        return $this->get('confirm.url');
    }
}