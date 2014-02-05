<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;
use GoWeb\Wa\Response\Mstatus\FileinfoIterator;

class Mstatus extends Response implements \IteratorAggregate
{
    public function getIterator()
    {
        return new FileinfoIterator($this->get('fileinfo'));
    }
}