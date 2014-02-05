<?php

namespace GoWeb\Wa\Response;

use GoWeb\Wa\Response;
use GoWeb\Wa\Response\Status\Fileinfo;

class Status extends Response
{
    private $_fileInfo;
    
    public function getFileInfo()
    {
        if(!$this->_fileInfo) {
            $this->_fileInfo = new Fileinfo;
            $this->_fileInfo->setFromArray($this->get('fileinfo'));
        }
        
        return $this->_fileInfo;
    }
    
    
}