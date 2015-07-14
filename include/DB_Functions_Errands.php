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
 
    /**
     * Storing new errand
     * returns errand details
     */
    public function createErrand($dateDebut, $duree, $distance) {
        $result = mysql_query("INSERT INTO Errand(state, dateDebut, duree, distance) VALUES(0, '$dateDebut', '$duree', '$distance')");
        // check for successful store
        if ($result) {
            // get user details 
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM Errand WHERE idErrand = $uid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	public function update($idErrand, $state, $dateDebut, $dateFin, $duree, $distance, $idCourier) {
		$result = mysql_query("UPDATE Errand SET state = '$state', dateDebut = '$dateDebut', dateFin = '$dateFin', duree = '$duree', distance = '$distance', Courier_idCourier = '$idCourier' WHERE idErrand = '$idErrand'") or die(mysql_error());
		if ($result) {
            $result = mysql_query("SELECT * FROM Errand WHERE idErrand = '$idErrand'");
			return mysql_fetch_array($result);
        } else {
            return false;
        }
	}
	
	public function delete($idErrand){
		$result = mysql_query("DELETE FROM Errand WHERE idErrand ='$idErrand'") or die(mysql_error());
		if ($result) {
            return $result;
        } else {
            return false;
        }
	}
	
	/**
     * Get errand by Id
	 http://localhost/Inovea/errand.php?tag=getById&id=2653
     */
    public function getById($id) {
        $result = mysql_query("SELECT * FROM Errand WHERE idErrand = '$id'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
			return $result;
        } else {
            // errand not found
            return false;
        }
    }
	
	/**
     * Get All errands
	 http://localhost/Inovea/errand.php?tag=getAll
     */
    public function getAll(){
        $result = mysql_query("SELECT * FROM Errand ") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
	
	public function getByCourier($id){
        $result = mysql_query("SELECT * FROM Errand WHERE Courier_idCourier = '$id'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
	
	public function getByState($state){
        $result = mysql_query("SELECT * FROM Errand WHERE state = '$state'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
    }
 
}
 
?>