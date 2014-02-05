<?php

namespace GoWeb\Wa\Response\Mstatus;

use GoWeb\Wa\Response\Status\Fileinfo;

class FileinfoIterator implements \Iterator
{
    private $_fileInfoList;
    
    private $_index = 0;
    
    public function __construct(array $list) 
    {        
        $this->_fileInfoList = $list;
    }
    
    /**
     * 
     * @return \GoWeb\Wa\Response\Status\Fileinfo
     */
    public function current()
    {        
        $fileInfo = new Fileinfo;
        $fileInfo->setFromArray(($this->_fileInfoList[$this->_index]));
        
        return $fileInfo;
    }
    
    public function next()
    {
        $this->_index++;
    }
    
    public function valid()
    {
        return isset($this->_fileInfoList[$this->_index]);
    }
    
    public function key()
    {
        return $this->_index;
    }
    
    public function rewind()
    {
        $this->_index = 0;
    }
}