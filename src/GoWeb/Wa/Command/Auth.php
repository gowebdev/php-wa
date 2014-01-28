<?php

namespace GoWeb\Wa\Command;

use GoWeb\Wa\Command;

class Auth extends Command
{
    public function setLogin($login)
    {
        $this->getRequest()->getQuery()->set('login', $login);
        return $this;
    }
    
    public function setPassword($password)
    {
        $this->getRequest()->getQuery()->set('password', $password);
        return $this;
    }
}