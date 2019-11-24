<?php
	
include 'rewardRedemption.php';
require "../Security/security.php";
require "../dbconnection/dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
	if (isset($_POST['distance'])){  #Get the distance from the routing
	#get the userID 
	$userID = security::sanitize($_POST["session_token"]);
	#get the distance covered
    $distance = security::sanitize($_POST["distance"]);
	
	$calPoints = (round($distance/0.5, 0)); #Calculation of the points from distance (1km = 2 points)
	
	$accumulatedPoints = getUserGamePoints($userID);
	$updatedPoints = $calPoints + $accumulatedPoints;

	routeUpdateUserPoints ($userID, $updatedPoints); //Push new calculated points into User Game profile


	}
}
?>  