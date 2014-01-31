<?php

namespace GoWeb\Wa;

class Response
{
    /**
     *
     * @var \Guzzle\Http\Message\Response
     */
    private $_response;
    
    /**
     *
     * @var array
     */
    private $_data;
    
    public function __construct(\Guzzle\Http\Message\Response $response) {
        $this->_response = $response;
        $this->_data = $response->json();
        
        if($this->isErrorOccured()) {
            throw new Exception($this->getErrorMessage());
        }
    }
    
    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : null;
    }
    
    public function get($selector)
    {
        if(false === strpos($selector, '.')) {
            return  isset($this->_data[$selector]) ? $this->_data[$selector] : null;
        }

        $value = $this->_data;
        foreach(explode('.', $selector) as $field)
        {
            if(!isset($value[$field])) {
                return null;
            }

            $value = $value[$field];
        }

        return $value;
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
        $message =  $this->get('strerror');
        
        if($this->get('msg')) {
            $message .= '' . $this->get('msg');
        }
        
        return $message;
    }
    
    public function __toString() {
        return (string) $this->_response;
    }
}