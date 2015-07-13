<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
	
	public function createContainer($name, $lat, $lng, $address) {
		echo "createContainer";
        $result = mysql_query("INSERT INTO Container(name, lat, lng, address, state, Errand_idErrand) VALUES('$name', '$lat', '$lng', '$address', 0, 1)");
		echo $result;
        if ($result) {
            $uid = mysql_insert_id(); 
            $result = mysql_query("SELECT * FROM Container WHERE idContainer = '$uid'");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	public function update($idContainer, $name, $lat, $lng, $state, $lastCollect, $address, $idErrand) {
	echo "update"; 
		$result = mysql_query("UPDATE Container SET name = '$name', lat = '$lat', lng = '$lng', state = '$state', lastCollect = '$lastCollect', address = '$address', Errand_idErrand = '$idErrand' WHERE idContainer = '$idContainer'") or die(mysql_error());
		if ($result) {
            //$uid = mysql_insert_id();
            $result = mysql_query("SELECT * FROM container WHERE idContainer = '$idContainer'");
            $no_of_rows = mysql_num_rows($result);
			if ($no_of_rows > 0) {
				return mysql_fetch_array($result);
			}
        } else {
            return false;
        }
	}
	
	public function delete($idContainer){
		$result = mysql_query("DELETE FROM Container WHERE idContainer = '$idContainer'") or die(mysql_error());
		if ($result) {
            return $result;
        } else {
            return false;
        }
	}
	
	public function getById($id) {
        $result = mysql_query("SELECT * FROM Container WHERE idContainer = '$id'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $container = mysql_fetch_array($result);
			return $container;
        } else {
            // errand not found
            return false;
        }
    }
	
	public function setState($id, $state) {
        $result = mysql_query("UPDATE Container SET state = '$state' WHERE idContainer = '$id'") or die(mysql_error());
		if ($result) {
            $result = mysql_query("SELECT * FROM container WHERE idContainer = '$id'");
            $no_of_rows = mysql_num_rows($result);
			if ($no_of_rows > 0) {
				return mysql_fetch_array($result);
			}
        } else {
            return false;
        }
    }
	
	public function getAll() {
		$result = mysql_query("SELECT * FROM Container") or die(mysql_error());
		$no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
	}
	
	public function getByErrand($id){
        $result = mysql_query("SELECT * FROM Container WHERE Errand_idErrand = '$id'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
	
	public function getByState($state){
        $result = mysql_query("SELECT * FROM Container WHERE state = '$state'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
 
}
 
?>