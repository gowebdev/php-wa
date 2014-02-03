<?php

namespace GoWeb\Wa;

class Structure
{
    /**
     *
     * @var array
     */
    private $_data;
    
    public function setFromArray(array $data)
    {
        $this->_data = $data;
        return $this;
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
}