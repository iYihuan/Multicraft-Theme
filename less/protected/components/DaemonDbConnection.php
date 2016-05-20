<?php
/**
 *
 *   Copyright © 2010-2014 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/

class DaemonDbConnection extends DbConnection
{
    public function init()
    {
        $this->version = 11;
        $this->type = 'daemon';
        parent::init();
    }
}
