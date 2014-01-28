<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;

class Remove extends Response
{
    public function getUrl()
    {
        return $this->get('remove.url');
    }
}