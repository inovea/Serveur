<?php
 
class DB_Functions {
 
    private $db;
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    function __destruct() {
         
    }
 
    public function createAlert($state, $description, $author, $idContainer) {
        $result = mysql_query("INSERT INTO Alert(state, description, date, author, Container_idContainer) VALUES('$state', '$description', NOW(), '$author', '$idContainer')");
        if ($result) {
            $uid = mysql_insert_id(); 
            $result = mysql_query("SELECT * FROM Alert WHERE idAlert = $uid");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	public function update($idAlert, $state, $description, $date, $author, $idContainer) {
		$result = mysql_query("UPDATE Alert SET state = '$state', description = '$description', date = '$date', author = '$author', Container_idContainer = '$idContainer' WHERE idAlert = '$idAlert'") or die(mysql_error());
		if ($result) {
            $result = mysql_query("SELECT * FROM Alert WHERE idAlert = '$idAlert'");
            $no_of_rows = mysql_num_rows($result);
			if ($no_of_rows > 0) {
				return mysql_fetch_array($result);
			}
        } else {
            return false;
        }
	}
	
	public function delete($idAlert){
		$result = mysql_query("DELETE FROM Alert WHERE idAlert = '$idAlert'") or die(mysql_error());
		if ($result) {
            return $result;
        } else {
            return false;
        }
	}

    public function getById($id) {
        $result = mysql_query("SELECT * FROM Alert WHERE idAlert = '$id'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
			return $result;
        } else {
            return false;
        }
    }
	
    public function getAll(){
        $result = mysql_query("SELECT * FROM Alert ") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
	
	public function getByContainer($id){
        $result = mysql_query("SELECT * FROM Alert WHERE Container_idContainer = '$id'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
	
	public function getByState($state){
        $result = mysql_query("SELECT * FROM Alert WHERE state = '$state'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
 
}
 
?>