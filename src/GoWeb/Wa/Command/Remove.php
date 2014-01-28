<?php

namespace GoWeb\Wa\Command;

use GoWeb\Wa\Command;

class Remove extends Command
{
    protected $_responseClass = '\GoWeb\Wa\Response\Remove';

    const CATEGORY_VOD  = 'vod';
    const CATEGORY_SOCS = 'socs';
    
    public function setCategory($category)
    {
        $this->getRequest()->getQuery()->set('category', $category);
        return $this;
    }
    
    public function setFileId($id)
    {
        $this->getRequest()->getQuery()->set('qid', $id);
        return $this;
    }
    
    public function setIp($ip)
    {
        $this->getRequest()->getQuery()->set('ip', $ip);
        return $this;
    }
}