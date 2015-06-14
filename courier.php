<?php
 
/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data
 
  /**
 * check for GET request 
 */
if (isset($_GET['tag']) && $_GET['tag'] != '') {
    // get tag
    $tag = $_GET['tag'];
 
    // include db handler
    require_once 'include/DB_Functions_Users.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => "0");
 
    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $mail = $_GET['mail'];
        $password = $_GET['password'];
 
        // check for user
        $user = $db->getUserByEmailAndPassword($mail, $password);
        if ($user != false) {
            // user found
			$response["error"] = "0";
            $response["user"]["idCourier"] = $user["idCourier"];
            $response["user"]["name"] = $user["name"];
			$response["user"]["firstname"] = $user["firstname"];
            $response["user"]["mail"] = $user["mail"];
            $response["user"]["scheduler"] = $user["scheduler"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = "1";
            $response["error_msg"] = "Incorrect mail or password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_GET['name'];
		$firstname = $_GET['firstname'];
        $mail = $_GET['mail'];
        $password = $_GET['password'];
		$scheduler = $_GET['scheduler'];
 
        // check if user is already existed
        if ($db->isUserExisted($mail)) {
            // user is already existed - error response
            $response["error"] = "2";
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($mail, $password, $name, $firstname, $scheduler);
            if ($user) {
                // user stored successfully
                $response["error"] = "0";
                $response["user"]["idCourier"] = $user["idCourier"];
				$response["user"]["name"] = $user["name"];
				$response["user"]["firstname"] = $user["firstname"];
				$response["user"]["mail"] = $user["mail"];
				$response["user"]["scheduler"] = $user["scheduler"];
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    } else if ($tag == 'getAll') {
		
		$result = $db->getAll();
		if($result){
			while($row = mysql_fetch_array($result)){
				$response["user"][] = array( "idCourier" => $row['idCourier'],
									"name" => $row['name'],
									"firstname" => $row['firstname'],
									"mail" => $row['mail'],
									"scheduler" => $row['scheduler']);
			}
			$response["error"] = "0";
			echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Liste vide";
            echo json_encode($response);
        }
		
    } 
	else if ($tag == 'getById') {
		$id = $_GET['idCourier'];
		$user = $db->getById($id);
		if ($user != false) {
			$response["error"] = "0";
            $response["user"]["idCourier"] = $user["idCourier"];
            $response["user"]["name"] = $user["name"];
			$response["user"]["firstname"] = $user["firstname"];
            $response["user"]["mail"] = $user["mail"];
            $response["user"]["scheduler"] = $user["scheduler"];
            echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Impossible de recuperer l'element!";
            echo json_encode($response);
        }
		
    } else if ($tag == 'update') {
		
		$idCourier = $_GET['idCourier'];
		$name = $_GET['name'];
		$firstname = $_GET['firstname'];
        $mail = $_GET['mail'];
		$scheduler = $_GET['scheduler'];
		
		$user = $db->update($idCourier, $name, $firstname, $mail, $scheduler);
		if ($user != false) {
			$response["error"] = "0";
            $response["user"]["idCourier"] = $user["idCourier"];
            $response["user"]["name"] = $user["name"];
			$response["user"]["firstname"] = $user["firstname"];
            $response["user"]["mail"] = $user["mail"];
            $response["user"]["scheduler"] = $user["scheduler"];
            echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Impossible de modifier l'element!";
            echo json_encode($response);
        }
		
    } else if ($tag == 'delete') {
		
		$idCourier = $_GET['idCourier'];
		
		$user = $db->delete($idCourier);
		if ($user != false) {
			$response["error"] = "0";
            echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Suppression impossible!";
            echo json_encode($response);
        }
		
    } else {
        // user failed to store
        $response["error"] = "1";
        $response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
	
	
} else {
    $response["error"] = "1";
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>