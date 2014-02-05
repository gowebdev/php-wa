<?php

namespace GoWeb\Wa\Command;

use GoWeb\Wa\Command;

class Mstatus extends Command
{
    protected $_responseClass = '\GoWeb\Wa\Response\Mstatus';

    const CATEGORY_VOD  = 'vod';
    const CATEGORY_SOCS = 'socs';
    
    public function setCategory($category)
    {
        $this->getRequest()->getQuery()->set('category', $category);
        return $this;
    }
    
    public function setFileIdList(array $idList)
    {
        $this->getRequest()->getQuery()->set('qid', implode(',', $idList));
        return $this;
    }
    
    public function setIp($ip)
    {
        $this->getRequest()->getQuery()->set('ip', $ip);
        return $this;
    }
}