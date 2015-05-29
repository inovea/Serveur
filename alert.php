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
    require_once 'include/DB_Functions_Alerts.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => "0");
 
    switch($tag){
		
		case "create" : 
			$state = $_GET['state'];
			$description = $_GET['description'];
			$author = $_GET['author'];
			$idContainer = $_GET['idContainer'];
			$alert = $db->createAlert($state, $description, $author, $idContainer);
			if ($alert) {
                $response["error"] = "0";
				$response["alert"]["idAlert"] = $alert["idAlert"];
				$response["alert"]["state"] = $alert["state"];
				$response["alert"]["description"] = $alert["description"];
				$response["alert"]["date"] = $alert["date"];
				$response["alert"]["author"] = $alert["author"];
				$response["alert"]["Container_idContainer"] = $alert["Container_idContainer"];
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in creating Alert";
                echo json_encode($response);
            }
			break;
			
		case "update" : 
			$idAlert = $_GET['idAlert'];
			$state = $_GET['state'];
			$description = $_GET['description'];
			$date = $_GET['date'];
			$author = $_GET['author'];
			$idContainer = $_GET['idContainer'];
			
			$alert = $db->update($idAlert, $state, $description, $date, $author, $idContainer);
			if ($alert) {
                $response["error"] = "0";
				$response["alert"]["idAlert"] = $alert["idAlert"];
				$response["alert"]["state"] = $alert["state"];
				$response["alert"]["description"] = $alert["description"];
				$response["alert"]["date"] = $alert["date"];
				$response["alert"]["author"] = $alert["author"];
				$response["alert"]["Container_idContainer"] = $alert["Container_idContainer"];
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in updating Alert";
                echo json_encode($response);
            }
			break;
			
		case "delete" : 
			$id = $_GET['idAlert'];
			$alert = $db->delete($id);
			if ($alert) {
				$response["error"] = "0";
				echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Suppression impossible!";
				echo json_encode($response);
			}
			break;
			
		case "getById" :
			$id = $_GET['idAlert'];
			$alert = $db->getById($id);
			if ($alert) {
				$response["error"] = "0";
				$response["alert"]["idAlert"] = $alert["idAlert"];
				$response["alert"]["state"] = $alert["state"];
				$response["alert"]["description"] = $alert["description"];
				$response["alert"]["date"] = $alert["date"];
				$response["alert"]["author"] = $alert["author"];
				$response["alert"]["Container_idContainer"] = $alert["Container_idContainer"];
                echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Impossible de récuperer l'alerte";
				echo json_encode($response);
			}
			break;
			
		case "getAll" : 
		$result = $db->getAll();
		if($result){
			while($row = mysql_fetch_array($result)){
				$response["alert"][] = array( "idAlert" => $row['idAlert'],
									"state" => $row['state'],
									"description" => $row['description'],
									"date" => $row['date'],
									"author" => $row['author'],
									"Container_idContainer" => $row['Container_idContainer']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
			
		case "getByContainer" : 
			$id = $_GET['idContainer'];
			$result = $db->getByContainer($id);
			if($result){
			while($row = mysql_fetch_array($result)){
				$response["alert"][] = array( "idAlert" => $row['idAlert'],
									"state" => $row['state'],
									"description" => $row['description'],
									"date" => $row['date'],
									"author" => $row['author'],
									"Container_idContainer" => $row['Container_idContainer']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
		
		case "getByState" : 
			$state = $_GET['state'];
			$result = $db->getByState($state);
			if($result){
			while($row = mysql_fetch_array($result)){
				$response["alert"][] = array( "idAlert" => $row['idAlert'],
									"state" => $row['state'],
									"description" => $row['description'],
									"date" => $row['date'],
									"author" => $row['author'],
									"Container_idContainer" => $row['Container_idContainer']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
		
		default :
			$response["error"] = TRUE;
			$response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register'";
			echo json_encode($response);
			break;
	}
	
	

} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>