<?php

namespace GoWeb\Wa\Response\Status;

use GoWeb\Wa\Structure;

class Fileinfo extends Structure
{
    public function getLastState()
    {
        return $this->get('laststate');
    }
}