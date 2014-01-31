<?php

namespace GoWeb\Wa;

abstract class Command
{    
    protected $_responseClass = '\\GoWeb\Wa\\Response';
    
    /**
     *
     * @var \GoWeb\Wa;
     */
    private $_wa;
    
    /**
     *
     * @var \Guzzle\Http\Message\RequestInterface
     */
    private $_request;
    
    public function __construct(\GoWeb\Wa $wa) {
        $this->_wa = $wa;
    }
    
    /**
     * 
     * @return \Guzzle\Http\Message\RequestInterface 
     */
    protected function getRequest()
    {
        if(!$this->_request) {
            $this->_request = $this->_wa
                ->getConnection()
                ->get('/');
            
            // apply token
            if(!($this instanceof \GoWeb\Wa\Command\Auth)) {
                if(!$this->_wa->isAuthorized()) {
                    throw new \Exception('Authorization token not specified');
                }
                
                $this->_request->addHeader('X-Auth-Token', $this->_wa->getToken());
            }
        }
        
        return $this->_request;
    }
    
    public function getCommandName()
    {
        $path = explode('\\', get_called_class());
        return strtolower(array_pop($path));
    }
    
    public function send()
    {
        $request = $this->getRequest();
        
        $request->getQuery()->set('command', $this->getCommandName());
        
        if($this->_wa->hasLogger()) {
            $this->_wa->getLogger()->debug((string) $request);
        }
        
        $response = $request->send();
    
        if($this->_wa->hasLogger()) {
            $this->_wa->getLogger()->debug((string) $response);
        }
        
        return new $this->_responseClass($response->json());
    }
}