<?php
/**
 *
 *   Copyright © 2010-2014 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/

class McErrors
{
    var $_errors = array();

    public function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function lastError()
    {
        $c = count($this->_errors);
        if (!$c)
            return false;
        return $this->_errors[$c - 1];
    }

    public function showErrors()
    {
        foreach ($this->_errors as $error)
            echo $error.'<br/>';
    }

    public function clearErrors()
    {
        $this->errors = array();
    }
}

