<?php

namespace GoWeb\Wa\Response\Status;

use GoWeb\Wa\Structure;

class Fileinfo extends Structure
{
    public function getLastState()
    {
        return $this->get('laststate');
    }
    
    public function isReady()
    {
        return 'user_t_ready' === $this->getLastState();
    }
    
    public function isRejected()
    {
        return 'user_t_deleted' === $this->getLastState();
    }
    
    public function isProcessed()
    {
        return !in_array($this->getLastState(), array(
            'user_t_ready',
            'user_t_deleted',
        ));
    }
    
    public function getPath()
    {
        return $this->get('url1');
    }
    
    public function getUrl()
    {
        return $this->get('url2');
    }
    
    public function getConfirmator()
    {
        return $this->get('confirmator');
    }
    
    public function isConfirmed()
    {
        return (bool) $this->getConfirmator();
    }
}