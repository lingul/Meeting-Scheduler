<?php
class Events {
  //Db
  private $_db,
          $_data,
          $_table,
          $_count;

  function __construct(){
    $this->_db = DB::getInstance();
    $this->_data = null;
    $this->_table = 'events';
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

  public function getEvents($id = null,$userid = false) {
    if ($id) {
      $field = $userid ? 'useremail' : 'id';
      $data = $this->_db->get($this->_table, array($field, '=', $id));
      if ($this->_count = $data->count()) {
        $this->_data = $data->results();
        return $this->data();
      }
    }
    return null;
  }
  
  public function getAllEvents() {
    $data = $this->_db->get($this->_table,array("*"));
    if ($this->_count = $data->count()) {
      $this->_data = $data->results();
      return $this->data();
    }
    return null;
  }

  public function data(){
    return $this->_data;
  }

  public function count(){
    return $this->_count;
  }

}
?>
