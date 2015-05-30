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
     * Storing new user
     * returns user details
	 * http://localhost/Inovea/user.php?tag=register&mail=oussama@gmail.com&password=myPassword&name=Bentalha&firstname=Oussama&scheduler=0
     */
    public function storeUser($mail, $password, $name, $firstname, $scheduler) {
		$encrypted_password = sha1($password);
        //$result = mysql_query("INSERT INTO Courier(idCourier, mail, encrypted_password, salt, name, firstname, scheduler) VALUES('$uuid', '$mail', '$password', '$salt', '$name', '$firstname', '$scheduler')");
		$result = mysql_query("INSERT INTO Courier(mail, encrypted_password, name, firstname, scheduler) VALUES('$mail', '$encrypted_password', '$name', '$firstname', '$scheduler')") or die(mysql_error());
        // check for successful store
        if ($result) {
            $result = mysql_query("SELECT * FROM Courier WHERE mail = '$mail'");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }
	
	public function update($idCourier, $name, $firstname, $mail, $password, $scheduler) {
		$encrypted_password = sha1($password);
		$result = mysql_query("UPDATE Courier SET name = '$name', firstname = '$firstname', mail = '$mail', encrypted_password = '$encrypted_password', scheduler = '$scheduler' WHERE idCourier = '$idCourier'") or die(mysql_error());
		if ($result) {
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM Courier WHERE idCourier = $uid");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
	}
	
	public function delete($idCourier){
		$result = mysql_query("DELETE FROM Courier WHERE idCourier = '$idCourier'") or die(mysql_error());
		if ($result) {
            return $result;
        } else {
            return false;
        }
	}
 
    /**
     * Get user by mail and password
	 * http://localhost/Inovea/courier.php?tag=login&mail=oussama@gmail.com&password=myPassword
     */
    public function getUserByEmailAndPassword($mail, $password) {
        $result = mysql_query("SELECT * FROM Courier WHERE mail = '$mail'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $encrypted_password = $result['encrypted_password'];
			if ($encrypted_password == sha1($password)) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }
	
	public function getById($id) {
		$result = mysql_query("SELECT * FROM Courier WHERE idCourier = '$id'") or die(mysql_error());
		$no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
            return mysql_fetch_array($result);
        } else {
            return false;
        }
	}
	
	public function getAll() {
		$result = mysql_query("SELECT * FROM Courier") or die(mysql_error());
		$no_of_rows = mysql_num_rows($result);
		if ($no_of_rows > 0) {
			return $result;
        } else {
            return false;
        }
	}
 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($mail) {
        $result = mysql_query("SELECT mail from Courier WHERE mail = '$mail'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
}
 
?>