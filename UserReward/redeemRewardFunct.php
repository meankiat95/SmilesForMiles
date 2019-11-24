<?php

include 'rewardRedemption.php';
 #$user = $_SESSION['user'];
 #$userID = $user->userID;


if ($_POST['submit'] == 'submit'){
	#$rewardID = $_POST['rewardID'];
	
	#validateEnoughPoints ($rewardID , $userID); //Will either redeem or fail to redeem - rewardRedemption.php

	$distance = '123.2';
	echo (round($distance/0.5 , 0));
	
	
	
	#Check if there is enough points for user to redeem rewards.
	
	#sendQR('mingkiat95@gmail.com', 'Smile4Miles Rewards Redemption', 'Please kindly scan the QR to redeem your rewards. ', '12345,FreeCoffeeRedeem');
}

?>  