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
    require_once 'include/DB_Functions_Errands.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => "0");
 
    switch($tag){
		
		case "create" : 
			$dateDebut = $_GET['dateDebut'];
			$duree = $_GET['duree'];
			$distance = $_GET['distance'];
			$errand = $db->createErrand($dateDebut, $duree, $distance);
			if ($errand) {
                $response["error"] = "0";
				$response["errand"]["idErrand"] = $errand["idErrand"];
				$response["errand"]["state"] = $errand["state"];
				$response["errand"]["dateDebut"] = $errand["dateDebut"];
				$response["errand"]["dateFin"] = $errand["dateFin"];
				$response["errand"]["duree"] = $errand["duree"];
				$response["errand"]["distance"] = $errand["distance"];
				$response["errand"]["Courier_idCourier"] = $errand["Courier_idCourier"];
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in creating Errand";
                echo json_encode($response);
            }
			break;
			
		case "update" : 
			$idErrand = $_GET['idErrand'];
			$state = $_GET['state'];
			$dateDebut = $_GET['dateDebut'];
			$dateFin = $_GET['dateFin'];
			$duree = $_GET['duree'];
			$distance = $_GET['distance'];
			$idCourier = $_GET['idCourier'];
			
			$errand = $db->update($idErrand, $state, $dateDebut, $dateFin, $duree, $distance, $idCourier);
			if ($errand) {
                $response["error"] = "0";
				$response["errand"]["idErrand"] = $errand["idErrand"];
				$response["errand"]["state"] = $errand["state"];
				$response["errand"]["dateDebut"] = $errand["dateDebut"];
				$response["errand"]["dateFin"] = $errand["dateFin"];
				$response["errand"]["duree"] = $errand["duree"];
				$response["errand"]["distance"] = $errand["distance"];
				$response["errand"]["Courier_idCourier"] = $errand["Courier_idCourier"];
                echo json_encode($response);
            } else {
                $response["error"] = "1";
                $response["error_msg"] = "Error occured in updating Errand";
                echo json_encode($response);
            }
			break;
			
		case "delete" : 
			$id = $_GET['idErrand'];
			$errand = $db->delete($idCourier);
		if ($errand) {
			$response["error"] = "0";
            echo json_encode($response);
        } else {
            $response["error"] = "1";
            $response["error_msg"] = "Suppression impossible!";
            echo json_encode($response);
        }
			break;
			
		case "getById" :
			$id = $_GET['idErrand'];
			$errand = $db->getById($id);
			if ($errand) {
				$response["error"] = "0";
				$response["errand"]["idErrand"] = $errand["idErrand"];
				$response["errand"]["state"] = $errand["state"];
				$response["errand"]["dateDebut"] = $errand["dateDebut"];
				$response["errand"]["dateFin"] = $errand["dateFin"];
				$response["errand"]["duree"] = $errand["duree"];
				$response["errand"]["distance"] = $errand["distance"];
				$response["errand"]["Courier_idCourier"] = $errand["Courier_idCourier"];
            echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Impossible de récuperer la course";
				echo json_encode($response);
			}
			break;
			
		case "getAll" : 
			$result = $db->getAll();
		if($result){
			while($row = mysql_fetch_array($result)){
				$response["errand"][] = array( "idErrand" => $row['idErrand'],
									"state" => $row['state'],
									"dateDebut" => $row['dateDebut'],
									"dateFin" => $row['dateFin'],
									"duree" => $row['duree'],
									"distance" => $row['distance'],
									"Courier_idCourier" => $row['Courier_idCourier']);
			}
			$response["error"] = "0";
			echo json_encode($response);
			} else {
				$response["error"] = "1";
				$response["error_msg"] = "Liste vide";
				echo json_encode($response);
			}
			break;
			
		case "getByCourier" : 
			$id = $_GET['idCourier'];
			$result = $db->getByCourier($id);
			if($result){
			while($row = mysql_fetch_array($result)){
				$response["errand"][] = array( "idErrand" => $row['idErrand'],
									"state" => $row['state'],
									"dateDebut" => $row['dateDebut'],
									"dateFin" => $row['dateFin'],
									"duree" => $row['duree'],
									"distance" => $row['distance'],
									"Courier_idCourier" => $row['Courier_idCourier']);
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
				$response["errand"][] = array( "idErrand" => $row['idErrand'],
									"state" => $row['state'],
									"dateDebut" => $row['dateDebut'],
									"dateFin" => $row['dateFin'],
									"duree" => $row['duree'],
									"distance" => $row['distance'],
									"Courier_idCourier" => $row['Courier_idCourier']);
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