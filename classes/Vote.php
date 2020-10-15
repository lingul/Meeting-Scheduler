<?php

class Vote {
    private $_db,
    $_data,
    $_table,
    $_count;

    function __construct(){
    $this->_db = DB::getInstance();
    $this->_data = null;
    $this->_table = 'vote';
    $this->_count = 0;
    }

    public function create($fields = array()){
    if($this->_db->insert($this->_table,$fields)){
        return (!$this->_db->error()) ? true : false;
    }
    return false;
    }

    public function exist() {
    return (!empty($this->_data)) ? true : false;
    }

    public function getAllByEventid($eventID = null) {
        if ($eventID) {
            $sql = 'SELECT * FROM ' . $this->_table . ' WHERE `eventid` = ?';
            $data = $this->_db->query($sql, array($eventID));
            if ($this->_resultCount = $data->count()) {
              $this->_data = $data->results();
              return $this->_data;
            }
        }
        return null;
      }
    public function find($email = null, $eventID = null) {

        if ($email && $eventID) {
            $sql = 'SELECT * FROM ' . $this->_table . ' WHERE `useremail` = ? AND `eventid` = ?';
            $data = $this->_db->query($sql, array($email, $eventID));
            if ($this->_resultCount = $data->count()) {
              $this->_data = $data->first();
              return $this->_data;
            }
        }
        return null;
      }
}