<?php
class User {
  //Db
  private $_db, 
          $_data,
          $_table,
          $_resultCount,
          $_isLoggedIn,
          $_sessionName;

  function __construct($user = null){
    $this->_db = DB::getInstance();
    $this->_sessionName = Config::get('session/session_name');
    $this->_data = null;
    $this->_resultCount = 0;
    $this->_table = 'users';
    if(!$user) {
      if(Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);
        if ($this->find($user)) {
          $this->_isLoggedIn = true;
        } else {
          //logout
          Session::delete($this->_sessionName);
        }
      }
    }
  }

  public function login($email = null, $password = null){
    $this->find($email);
    if ($this->_data) {
        if ($this->_data->password === $password) {
            unset($this->_data->password);
            Session::put(Config::get('session/session_name'), $this->_data->email);
            return $this->_data->email;
        }
      }
    return null;
  }

  public function logout(){
    Session::delete($this->_sessionName);
  }

  public function signup($fields = array()){
    if (!$this->find($fields['email'])) {
      if($this->_db->insert($this->_table, $fields)){
        return $this->login($fields['email'], $fields['password']);
  		}
    }
    return null;
  }

  public function exist(){
      return (!empty($this->_data)) ? true : false;
  }

  public function getAllUsers() {
      $data = $this->_db->get($this->_table,array("firstname","lastname","email"));
      if ($this->_resultCount = $data->count()) {
          $this->_data = $data->results();
          return $this->_data;
      }
      return null;
  }

  public function find($user = null){
    if ($user) {
        $field = 'email';
        $data = $this->_db->get($this->_table, array($field, '=', $user));
        if ($this->_resultCount = $data->count()) {
          $this->_data = $data->first();
          return $this->_data;
        }
    }
    return null;
  }

  public function findUser($user = null){
  	$this->find($user);
  	unset($this->_data->password);
  	return $this->_data;
  }

  public function isLoggedIn(){
    return $this->_isLoggedIn;
  }
  public function data(){
    return $this->_data;
  }

  public function count(){
    return $this->_resultCount;
  }
}
?>