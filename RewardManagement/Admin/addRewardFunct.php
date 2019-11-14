<?php
        include 'rewardManagement.php';

        $rewardName = $_POST['rewardName'];
		$rewardPoints = $_POST['rewardPoints'];
		$rewardDescription = $_POST['rewardDescription'];
		$rewardContactInfo = $_POST['rewardContactInfo'];
      
        $imageName = $_FILES["rewardImagePath"]["name"]; //Retrieve the image file name from HTML input file type
        $imagetmp = file_get_contents($imageName); 

		addReward($rewardName, $rewardPoints, $rewardDescription, $rewardContactInfo, $imagetmp);

?>  