<?php
include '../db.php';
function addReward( $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp) {
	include '../db.php';
	$rewardDeactivate = 1;
	$edeemCounter = 0;
    if (!empty($rewardName) && !empty($rewardPoints) && $rewardPoints > 0 && !empty($rewardDescription) && !empty($imagetmp)) { //Ensure that required details are not null before sent to DB
		$rewardID = retrieveLastRewardID();	
		$insert = "INSERT INTO reward (rewardID, rewardName, rewardPoints, rewardDescription, rewardContactInfo, rewardImagePath, redeemCounter, rewardDeactivate) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($insert);
		$stmt->bind_param("ssssssii", $rewardID, $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp, $redeemCounter, $rewardDeactivate);
		}
		
	else{
          echo ("<script LANGUAGE='JavaScript'> window.alert('Fail to add new rewards. Some required fields are missing or incorrect.'); window.location.href='adminViewRewards.php'; </script>");
        }
	

    $stmt->execute();
	$stmt->close();
	echo ("<script LANGUAGE='JavaScript'> window.alert('Reward successfully added into system.');window.location.href='index.html';</script>");
}

function modifyReward($rewardID, $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp) {
	include '../db.php';
    $insert = '';
    if (!empty($rewardID) && is_numeric($rewardID)) { //Ensure rewardID is not empty and is number
        if (!empty($rewardName) && !empty($rewardPoints) && $rewardPoints > 0 && !empty($rewardDescription)) { //Ensure that required details are not null before sent to DB
            if (empty($imagetmp)) { //Check if admin wanted to change rewardImage
                $insert = "UPDATE reward SET rewardName = ?, rewardPoints = ?, rewardDescription = ?, rewardContactInfo = ? WHERE rewardID = '$rewardID'"; //No updating of image
                $stmt = $db->prepare($insert);
                $stmt->bind_param("ssss", $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo);
                echo "<script type='text/javascript'>alert('[No image attached] System will not make any changes to the existing reward image')</script>";
            } 
            else {
                $insert = "UPDATE reward SET rewardName = ?, rewardPoints = ?, rewardDescription = ?, rewardContactInfo = ?, rewardImagePath = ? WHERE rewardID = '$rewardID'";
                $stmt = $db->prepare($insert);
                $stmt->bind_param("sssss", $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp); //Update everything except RewardID
            }
            $stmt->execute();
            $stmt->close();
            echo ("<script LANGUAGE='JavaScript'> window.location.href='adminViewRewards.php';</script>");
        } 
        else {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Reward details failed to update. Some required fields are missing or incorrect.'); window.location.href='adminViewRewards.php'; </script>");
        }
    } 
    else {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Reward update fail. RewardID is invalid.'); window.location.href='adminViewRewards.php'; </script>");
    }
}

function deactivateReward($rewardID){ //Deactivate reward according to rewardID
	include '../db.php';

	$sql = "UPDATE reward SET rewardDeactivate = '1' WHERE `rewardID` = '" . $rewardID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db->close();
	echo ("<script LANGUAGE='JavaScript'> window.alert('Reward deactivated successfully.');window.location.href='adminViewRewards.php';</script>");

}

function activateReward($rewardID){ //Deactivate reward according to rewardID
	include '../db.php';

	$sql = "UPDATE reward SET rewardDeactivate = '0' WHERE `rewardID` = '" . $rewardID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db->close();
	echo ("<script LANGUAGE='JavaScript'> window.alert('Reward Re-activated successfully.');window.location.href='adminViewRewards.php';</script>");

}

function listAllActivatedRewards(){ // To retrieve all activated rewards' detail in reward table - Method used by adminViewRewards.php
	include '../db.php';
    $sql = "SELECT rewardID, rewardName, rewardImagePath FROM reward WHERE rewardDeactivate = '0'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();
				
    $db->close();
	return $result;
}

function listAllDeactivatedRewards(){ // To retrieve all deactivated rewards' detail in reward table - Method used by adminViewRewards.php
	include '../db.php';
    $sql = "SELECT rewardID, rewardName, rewardImagePath FROM reward WHERE rewardDeactivate = '1'";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();
				
    $db->close();
	return $result;
}

function listSelectedReward($rewardID){ //To retrieve specific reward details - modifyReward.php
	include '../db.php';
    $sql = "SELECT rewardID, rewardName, rewardPoints, rewardDescription, rewardContactInfo, rewardImagePath FROM reward WHERE rewardID = '" . $rewardID . "'";
    $stmt = $db->prepare($sql);

    $stmt->execute();
    $result = $stmt->get_result();
	$db->close();
    return $result;
		

}

function retrieveLastRewardID (){ //Retrieve the last rewardID in the DB
	include '../db.php';
	$rewardID ='';
	$sql = "SELECT rewardID FROM mydatabase.reward ORDER BY rewardID DESC LIMIT 1";
	$stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
	if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
				$rewardID = $row['rewardID'];
	
			}
	}
	$db->close();
    return $rewardID+1; //Increment the rewardID by 1
}



?>  