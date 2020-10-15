<?php

class Attendens { 

    private $_db,
    $_data,
    $_table,
    $_count;

    function __construct(){
        $this->_db = DB::getInstance();
        $this->_data = null;
        $this->_table = 'attendens';
        $this->_count = 0;
    }

    public function create($fields = array()) {
        if($this->_db->insert($this->_table,$fields)){
            return (!$this->_db->error()) ? true : false;
        }
        return false;
    }

    public function getAttendens($id = null, $userEmail = false) {
        if ($id) {
            $field = $userEmail ? 'email' : 'eventid';
            $data = $this->_db->get($this->_table, array($field, '=', $id));
            if ($this->_count = $data->count()) {
            $this->_data = $data->results();
            return $this->data();
            }
        }
        return null;
    }

    public function getEvents($userEmail = null) {
        if ($userEmail) {
            $sql = 'SELECT events.* FROM ' . $this->_table . ' INNER JOIN events ON events.id=attendens.eventid WHERE `email` = ?';
            $data = $this->_db->query($sql, array($userEmail));
            if ($this->_count = $data->count()) {
                $this->_data = $data->results();
                return $this->data();
            }
        }
        return null;
    }
    public function data(){
        return $this->_data;
    }

    public function count(){
        return $this->_count;
    }

    //   
}