<?php

include 'rewardManagement.php';
$rewardID = $_POST['rewardID'];
if ($_POST['submit'] == 'submit'){
	
	$rewardName = $_POST['rewardName'];
	$rewardPoints = $_POST['rewardPoints'];
	$rewardDescription = $_POST['rewardDescription'];
	$rewardContactInfo = $_POST['rewardContactInfo'];
	$imagetmp = '';

	$imageName = $_FILES["rewardImagePath"]["name"]; //Retrieve the image file name from HTML input file type
	if (!empty($imageName)) {
		$imagetmp = file_get_contents($imageName);
	}
	modifyReward($rewardID, $rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp);
}
else if ($_POST['submit'] == 'activate'){
	activateReward($rewardID);
}
?>  