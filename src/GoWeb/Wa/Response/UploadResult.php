<?php

namespace GoWeb\Wa\Response;

use \GoWeb\Wa\Structure;

class UploadResult extends Structure
{
    private $_key;
    
    /**
     * Set file's input name
     * 
     * @param type $key
     */
    public function setKey($key)
    {
        $this->_key = $key;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->get('extra.uploads.' . $this->_key . '.status');
    }
    
    public function isErrorOccured()
    {
        return 0 !== $this->getStatus();
    }
    
    public function getErrorMessage()
    {
        return $this->get('extra.uploads.' . $this->_key . '.strerror');
    }
    
    public function getId()
    {
        return $this->get('extra.uploads.' . $this->_key . '.id');
    }
}