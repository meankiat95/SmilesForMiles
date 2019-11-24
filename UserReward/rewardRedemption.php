<?php
include '../db.php';
include '../PHPMailer/email.php';
include '../Cryptography/encryptDecrypt.php';

function getRewardPoints($rewardID){ //Retrieve the rewardPoints - reward table 
	include '../db.php';
	$sql = "SELECT rewardPoints FROM reward WHERE `rewardID` = '" . $rewardID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$rewardPoint = 0;
    
    $result = $stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rewardPoint = $row["rewardPoints"];
            }
        } else {
            echo "No result";
        }			
    $db->close();
	return $rewardPoint;
}

function getRewardName($rewardID){ //Retrieve the rewardName - reward table 
	include '../db.php';
	$sql = "SELECT rewardName FROM reward WHERE `rewardID` = '" . $rewardID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$rewardName = 0;
 
    $result = $stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rewardName = $row["rewardName"];
            }
        } else {
            echo "No result";
        }			
    $db->close();
	return $rewardName;
}

function updateRedeemedCounter($rewardID){ //Update the number of times this reward has been redeemed
	include '../db.php';

	$sql = "UPDATE reward SET redeemCounter = redeemCounter + 1 WHERE `rewardID` = '" . $rewardID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db->close();
}

function getUserGamePoints ($userID){ //Retrieve the points user accumulated - gameProfile table
	include '../db.php';	
	$sql = "SELECT points FROM gameprofile WHERE `userID` = '" . $userID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$userGamePoint = 0;
    
    $result = $stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$userGamePoint = $row["points"];
            }
        } else {
            echo "No result";
        }			
    $db->close();
	
	return $userGamePoint;	
	

}

function validateEnoughPoints($rewardID, $userID){ //compare rewardPoints and userAccumulatedPoints 
	$requriedPoints = getRewardPoints($rewardID); //Save required points into variable
	$myPoints = getUserGamePoints ($userID); //Save my current points into variable
	#echo ("<script LANGUAGE='JavaScript'> window.alert('Reward point = " .$requriedPoints. "Your points = " .$myPoints. "');</script>");
	if ($myPoints < $requriedPoints){
		echo ("<script LANGUAGE='JavaScript'> window.alert('You do not have enough points.');</script>");
	}
	else {
		$remainingPoints =  $myPoints - $requriedPoints; // Deduct reward points from user's game points
		#echo ("<script LANGUAGE='JavaScript'> window.alert('You still have " .$remainingPoints. "points.');</script>");
		updateUserGamePoints($rewardID, $userID, $remainingPoints);
	}
}

function updateUserGamePoints ($rewardID, $userID, $updatedPoints){ //Amend the latest game points into the database - gameProfile table
	include '../db.php';
	$sql = "UPDATE gameprofile SET points = '" . $updatedPoints . "' WHERE `userID` = '" . $userID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db->close();
	
	$emailRecipient = getUserEmail($userID);
	
	$rewardName = getRewardName($rewardID);
	
	$emailSubject = "Reward Redemption Successful [" . $rewardName . "]"; 
	
	$emailContent = "Hi, you have successfully redeem the following reward ->" . $rewardName;
	
	$QRContent = $rewardID."#".$rewardName."#".$userID;
	$EncryptedQRContent = AES256CBCEncryption($QRContent);
	
	sendEmailQR($emailRecipient, $emailSubject, $emailContent, $EncryptedQRContent);
	updateRedeemedCounter($rewardID);
	echo ("<script LANGUAGE='JavaScript'> window.alert('You have successfully redeem reward. Please check your email for redemption QR Code.');window.location.href='userViewRewards.php';</script>");
}

function routeUpdateUserPoints($userID, $updatedPoints){
	
	include '../db.php';
	$sql = "UPDATE gameprofile SET points = '	" . $updatedPoints . "' WHERE `userID` = '" . $userID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db->close();
	echo ("<script LANGUAGE='JavaScript'>window.location.href='showGameProfile.php';</script>");

	
}
function getUserEmail ($userID) { //Retrieve the user email - user table 

	include '../db.php';
	$sql = "SELECT email FROM user WHERE `userID` = '" . $userID . "'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$userEmail = 0;
    
    $result = $stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$userEmail = $row["email"];
            }
        } else {
            echo "No result";
        }			
    $db->close();
	return $userEmail;
}


?>  