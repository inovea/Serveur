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
	
	public function update($idCourier, $name, $firstname, $mail, $scheduler) {
		$encrypted_password = sha1($password);
		$result = mysql_query("UPDATE Courier SET name = '$name', firstname = '$firstname', mail = '$mail', scheduler = '$scheduler' WHERE idCourier = '$idCourier'") or die(mysql_error());
		if ($result) {
            $result = mysql_query("SELECT * FROM Courier WHERE idCourier = $idCourier");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
	}
	
	public function changePassword($mail, $password){
		$encrypted_password = sha1($password);
		
		$result = mysql_query("UPDATE Courier SET encrypted_password = '$encrypted_password' WHERE mail = '$mail'") or die(mysql_error());			
        if ($result) {
            $result = mysql_query("SELECT * FROM Courier WHERE mail = '$mail'");
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


    public function sendMail($mail, $password) {
        // PREPARE THE BODY OF THE MESSAGE
        $message = '<html><body>';
        //$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Utilisateur : </strong> </td><td>" . $mail . "</td></tr>";
        $message .= "<tr><td><strong>Nouveau mot de passe : </strong> </td><td>" . $password . "</td></tr>";
        //$addURLS = $_POST['addURLS'];
        $message .= "</table>";
        $message .= "</body></html>";
 
        $subject = 'Initialisation de votre mot de passe';
            
        $headers = "From: inovea.esgi@gmail.com \r\n";
        $headers .= "Reply-To: ". $mail . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($mail, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
 
?>