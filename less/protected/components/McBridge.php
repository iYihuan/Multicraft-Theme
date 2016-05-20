<?php
/**
 *
 *   Copyright © 2010-2014 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/

class McBridge extends McErrors
{
    public $autoconnect;
    public $socketTimeout;

    private $connections = array();
    private static $inst = null;
    private $daemonIds = false;
    private $passwords = array();

    private function __construct($autoconnect = true)
    {
        $this->socketTimeout = Yii::app()->params['timeout'];
        $this->autoconnect = $autoconnect;
        $this->passwords = @include(dirname(__FILE__).'/../config/daemons.php');
        if (!is_array($this->passwords))
            $this->passwords = array();
        $this->passwords['default'] = array('password' => Yii::app()->params['daemon_password']);
    }
    
    static function get()
    {
        if (Yii::app()->params['demo_mode'] == 'enabled')
            McBridge::$inst = McBridgeDemo::get();
        if (!McBridge::$inst)
            McBridge::$inst = new McBridge();
        return McBridge::$inst;
    }

    public function conStrings()
    {
        $c = array();
        $ids = $this->getDaemonIds(); 
        foreach ($ids as $id)
        {
            $con = $this->getConnection($id);
            if (!$con)
                continue;
            $c[$id] = 'ID '.$id.' - '.$con->name.' ('.$con->ip.')';
        }
        return $c;
    }

    public function getConnection($id)
    {
        if (@isset($this->connections[$id]))
            return $this->connections[$id];
        $daemon = Daemon::model()->findByPk((int)$id);
        if (!$daemon)
            return null;
        $pw = isset($this->passwords[$id]['password']) ? $this->passwords[$id]['password']
            : @$this->passwords['default']['password'];
        $con = new McConnection($this, $id, $daemon->name, $daemon->ip, $daemon->port, $pw, $daemon->token);
        return ($this->connections[$id] = $con);
    }

    public function getDaemonIds()
    {
        if (!$this->daemonIds)
        {
            $cmd = Daemon::model()->getDbConnection()->createCommand('select `id` from `daemon`');
            $this->daemonIds = $cmd->queryColumn();
        }
        return $this->daemonIds;
    }

    public function connectionCount()
    {
        return count($this->getDaemonIds());   
    }

    public function serverCmd($server, $cmd, &$data = null, $broadcast = false, $nocache = false)
    {
        $command = $cmd;
        $r = array();
        if (($cache = CommandCache::get($server, $command, $r)) === 1)
        {
            if (@$r['success'])
            {
                $data = @$r['data'];
                return true;
            }
            $this->addError(@$r['error']);
            return false;
        }
        $cmd = 'server '.$server.':'.$cmd;
        $ret = array();
        if ($broadcast)
            $ret = $this->globalCmd($cmd);
        else
        {
            $ret = array($this->cmd(Server::getDaemon($server), $cmd));
        }
        $e = '';
        foreach ($ret as $r)
        {
            if ($cache !== 0)
                CommandCache::set($server, $command, $r);
            if ($r['success'])
            {
                $data = $r['data'];
                return true;
            }
            $e = $r['error'];
        }
        $this->addError($e);
        return false;
    }

    public function globalCmd($cmd)
    {
        Yii::log('Sending command "'.$cmd.'" to all daemons');
        $this->clearErrors();
        $ret = array();
        $ids = $this->getDaemonIds();
        foreach ($ids as $id)
        {
            $con = $this->getConnection($id);
            if (!$con)
                continue;
            $ret[$id] = array();
            $d = array();
            $ret[$id]['success'] = $con->command($cmd, $d);
            $ret[$id]['data'] = $d;
            $ret[$id]['error'] = $con->lastError();
        }
        return $ret;
    }

    public function cmd($daemon, $cmd)
    {
        if (!preg_match('/^(server\s+\d+\s*:(get\s|plugin has|backup (status|list))|updatejar (list|status)|cfgfile (check|get)|version)/', $cmd))
            Yii::log('Sending command "'.$cmd.'" to daemon '.$daemon);
        $this->clearErrors();
        $ret = array();
        $con = $this->getConnection($daemon);
        if (!$con)
        {
            $ret['success'] = false;
            $ret['data'] = '';
            $ret['error'] = Yii::t('mc', 'No connection for daemon {id}', array('{id}'=>$daemon));
            return $ret;
        }
        $d = array();
        $ret['success'] = $con->command($cmd, $d);
        $ret['data'] = $d;
        $ret['error'] = $con->lastError();
        return $ret;
    }

    static function parse($data)
    {
        if (!$data)
            return array();
        if (!is_array($data))
            $data = array($data);

        $ret = array();
        foreach ($data as $line)
        {
            $items = preg_split('/ :/', $line);
            $data = array();
            for ($i = 0; ($i + 1) < count($items); $i += 2)
                $data[$items[$i]] = preg_replace('/\\\\\\\\/', '\\', preg_replace('/ \\\:/', ' :', $items[$i+1]));
            $ret[] = $data;
        }
        return $ret;
    }

}

