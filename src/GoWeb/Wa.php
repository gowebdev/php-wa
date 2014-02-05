<?php

namespace GoWeb;

use Guzzle\Http\Client;

/**
 * @link http://techdocs.telehouse-ua.net/интернет_тв:техническая_документация:разработки:служебное_по:wa
 */
class Wa
{
    private $_serverURL;
    
    private $_login;
    
    private $_password;
    
    private $_token;
    
    private $_connection;
    
    private $_logger;
    
    /**
     * 
     * @param type $url
     * @return \GoWeb\Wa
     */
    public function setServer($url)
    {
        $this->_serverURL = $url;
        
        return $this;
    }
    
    public function getServer()
    {
        return $this->_serverURL;
    }
    
    /**
     * 
     * @param type $login
     * @param type $password
     * @return \GoWeb\Wa
     */
    public function setCredentials($login, $password)
    {
        $this->_login = $login;
        $this->_password = $password;
        
        return $this;
    }
    
    
    public function isAuthorized()
    {
        return (bool) $this->_token;
    }
    
    public function getToken()
    {
        return $this->_token;
    }
    
    public function setToken($token)
    {
        $this->_token = $token;
        return $this;
    }
    
    /**
     * 
     * @return \Guzzle\Http\Client
     */
    public function getConnection()
    {
        if(!$this->_connection) {
            $this->_connection = new Client($this->_serverURL);
        }
        
        return $this->_connection;
    }
    
    /**
     * 
     * @param \Guzzle\Http\Client $connection
     * @return \GoWeb\Wa
     */
    public function setConnection(Client $connection)
    {
        $this->_connection = $connection;
        return $this;
    }
    
    /**
     * 
     * @param string $command
     * @return \Goweb\Wa\Command
     * @throws \Exception
     */
    public function createCommand($command)
    {
        if(!$this->isAuthorized() && $command != 'auth') {
            $response = $this->createCommand('auth')
                ->setLogin($this->_login)
                ->setPassword($this->_password)
                ->send();
            
            $this->_token = $response->token;
        }
        
        // create command
        $className = '\\GoWeb\\Wa\\Command\\' . ucfirst(strtolower($command));
        if(!class_exists($className)) {
            throw new \Exception('Command not found');
        }
        
        return new $className($this);
    }
    
    /**
     * 
     * @return \GoWeb\Wa\Command\Upload
     */
    public function upload()
    {
        return $this->createCommand('upload');
    }
    
    /**
     * 
     * @return \GoWeb\Wa\Command\Delete
     */
    public function delete()
    {
        return $this->createCommand('delete');
    }
    
    /**
     * 
     * @return \GoWeb\Wa\Command\Mstatus
     */
    public function multiStatus()
    {
        return $this->createCommand('mstatus');
    }
    
    /**
     * 
     * @return \GoWeb\Wa\Command\Confirm
     */
    public function confirm()
    {
        return $this->createCommand('confirm');
    }
    
    public function setLogger(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
        return $this;
    }
    
    /**
     * 
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->_logger;
    }
    
    public function hasLogger()
    {
        return (bool) $this->_logger;
    }
}