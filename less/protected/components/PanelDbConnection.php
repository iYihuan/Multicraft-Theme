<?php
/**
 *
 *   Copyright © 2010-2014 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/

class PanelDbConnection extends DbConnection
{
    public function init()
    {
        $this->version = 11;
        $this->type = 'panel';
        parent::init();
    }
}
