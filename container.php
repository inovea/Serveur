
<?php
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: GET, PUT, DELETE');
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
    require_once 'include/DB_Functions_Containers.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => "0");
 
    switch($tag){
		
		case "create" : 
			$name = $_GET['name'];
			$lat = $_GET['lat'];
			$lng = $_GET['lng'];
			$address = $_GET['address'];
			
			$container = $db->createContainer($name, $lat, $lng, $address);
			if ($container) {
                $response["error"] = "0";
				$response["container"]["idContainer"] = $container["idContainer"];
				$response["container"]["name"] = $container["name"];
				$response["container"]["lat"] = $container["lat"];
				$response["container"]["lng"] = $container["lng"];
				$response["container"]["state"] = $container["state"];
				$response["container"]["lastCollect"] = $container["lastCollect"];
				$response["container"]["address"] = $container["address"];
				$response["container"]["Errand_idErrand"] = $container["Errand_idErrand"];
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in creating Container";
                echo json_encode($response);
            }
			break;
			
		case "update" : 
			$idContainer = $_GET['idContainer'];
			$name = $_GET['name'];
			$lat = $_GET['lat'];
			$lng = $_GET['lng'];
			$state = $_GET['state'];
			$lastCollect = $_GET['lastCollect'];
			$address = $_GET['address'];
			$idErrand = $_GET['idErrand'];
			
			$container = $db->update($idContainer, $name, $lat, $lng, $state, $lastCollect, $address, $idErrand);
			if ($container) {
                $response["error"] = "0";
				$response["container"]["idContainer"] = $container["idContainer"];
				$response["container"]["name"] = $container["name"];
				$response["container"]["lat"] = $container["lat"];
				$response["container"]["lng"] = $container["lng"];
				$response["container"]["state"] = $container["state"];
				$response["container"]["lastCollect"] = $container["lastCollect"];
				$response["container"]["address"] = $container["address"];
				$response["container"]["Errand_idErrand"] = $container["Errand_idErrand"];            
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in updating Container";
                echo json_encode($response);
            }
			break;
			
		case "delete" : 
			$id = $_GET['idContainer'];
			$container = $db->delete($id);
		if ($container) {
			$response["error"] = "0";
            echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Suppression impossible!";
            echo json_encode($response);
        }
			break;
			
		case "getById" :
			$id = $_GET['idContainer'];
			$container = $db->getById($id);
			if ($container) {
				$response["error"] = "0";
				$response["container"]["idContainer"] = $container["idContainer"];
				$response["container"]["name"] = $container["name"];
				$response["container"]["lat"] = $container["lat"];
				$response["container"]["lng"] = $container["lng"];
				$response["container"]["state"] = $container["state"];
				$response["container"]["lastCollect"] = $container["lastCollect"];
				$response["container"]["address"] = $container["address"];
				$response["container"]["Errand_idErrand"] = $container["Errand_idErrand"];    
            echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Impossible de récuperer le container";
				echo json_encode($response);
			}
			break;
			
		case "getAll" : 
			$result = $db->getAll();
			if($result){
			while($row = mysql_fetch_array($result)){
				$response["container"][] = array( "idContainer" => $row['idContainer'],
									"name" => $row['name'],
									"lat" => $row['lat'],
									"lng" => $row['lng'],
									"state" => $row['state'],
									"lastCollect" => $row['lastCollect'],
									"address" => $row['address'],
									"Errand_idErrand" => $row['Errand_idErrand']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
			
		case "getByErrand" : 
			$id = $_GET['idErrand'];
			$result = $db->getByErrand($id);
			if($result){
			while($row = mysql_fetch_array($result)){
				$response["container"][] = array( "idContainer" => $row['idContainer'],
									"name" => $row['name'],
									"lat" => $row['lat'],
									"lng" => $row['lng'],
									"state" => $row['state'],
									"lastCollect" => $row['lastCollect'],
									"address" => $row['address'],
									"Errand_idErrand" => $row['Errand_idErrand']);
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
				$response["container"][] = array( "idContainer" => $row['idContainer'],
									"name" => $row['name'],
									"lat" => $row['lat'],
									"lng" => $row['lng'],
									"state" => $row['state'],
									"lastCollect" => $row['lastCollect'],
									"address" => $row['address'],
									"Errand_idErrand" => $row['Errand_idErrand']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
			
		case "setState" :
			$id = $_GET['idContainer'];
			$state = $_GET['state'];
			$container = $db->setState($id, $state);
			if ($container) {
				$response["error"] = "0";
				$response["container"]["idContainer"] = $container["idContainer"];
				$response["container"]["name"] = $container["name"];
				$response["container"]["lat"] = $container["lat"];
				$response["container"]["lng"] = $container["lng"];
				$response["container"]["state"] = $container["state"];
				$response["container"]["lastCollect"] = $container["lastCollect"];
				$response["container"]["address"] = $container["address"];
				$response["container"]["Errand_idErrand"] = $container["Errand_idErrand"];    
            echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Impossible de récuperer le container";
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