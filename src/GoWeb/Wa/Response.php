<?php

namespace GoWeb\Wa;

class Response extends Structure
{
    /**
     *
     * @var \Guzzle\Http\Message\Response
     */
    private $_response;
    
    public function __construct(\Guzzle\Http\Message\Response $response) {
        $this->_response = $response;
        $this->setFromArray($response->json());
        
        if($this->isErrorOccured()) {
            throw new Exception($this->getErrorMessage());
        }
    }
    
    
    
    public function getStatus()
    {
        return (int) $this->get('status');
    }
    
    public function isErrorOccured()
    {
        return 0 !== $this->getStatus();
    }
    
    public function getErrorMessage()
    {
        $message =  'Error #' . $this->getStatus() . ': ' . $this->get('strerror');
        
        if($this->get('msg')) {
            $message .= '; ' . $this->get('msg');
        }
        
        return $message;
    }
    
    public function __toString() {
        return (string) $this->_response;
    }
}