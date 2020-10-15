<?php
class DB {
	private static $_instance = null;
	private $_pdo;
	private	$_query;
	private	$_error = false;
	private	$_results;
	private	$_count = 0;

	public function __construct() {
		$this->_pdo = null;
		try {
			$this->_pdo = new PDO('mysql:host='. Config::get('mysql/host').';dbname='. Config::get('mysql/database'),
					Config::get('mysql/username'), Config::get('mysql/password'));
		} catch (PDOException $e) {
			die($e->getMessage());
		}

	}

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

	public function query($sql,$values = array()) {
		$this->error = false;
		if($this->_query = $this->_pdo->prepare($sql)) {
			if (count($values)) {
				$x = 1;
				foreach ($values as $value) {
					$this->_query->bindValue($x, $value);
					$x++;
				}
			}
			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

	public function search($sql) {
		$this->error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if ($this->_query->execute(['s' => "{$_GET['s']}%"])) {
				$this->_results = $this->_query->fetchAll();
			}
		}
		return $this->_results;
	}

	public function action($action, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=');
			
			if(in_array($where[1], $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$where[0]} {$where[1]} ?";
				if(!$this->query($sql, array($where[2]))->error()) {
					return $this;
				}
			}
		}
		return false;
	}

	public function get($table, $where = array()) {
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where = array()) {
		return $this->action('DELETE', $table, $where);
	}

	public function insert($table, $fields = array()) {
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = '';
			$i = 1;

			foreach($fields as $field) {
				$values .= '?';
				if($i < count($fields)) {
					$values .= ', ';
				}
				$i++;
			}

			$sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";

			if(!$this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return false;
	}

	public function update($table,$columns = array(),$operators = array(), $values = array(), $where = array()) {

	}

	public function results() {
		return $this->_results;
	}

	public function first() {
		return $this->_results[0];
	}

	public function error() {
		return $this->_error;
	}

	public function count() {
		return $this->_count;
	}

}
