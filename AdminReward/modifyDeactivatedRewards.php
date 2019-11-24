<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
		include 'rewardManagement.php';
        $rewardID = $_POST['rewardID']; //rewardID selected by the previous page ("viewRewards.php")
		
		$result = listSelectedReward($rewardID);

        $count = 0;

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                ?>

                <!-- Page Content -->
                
                    <div class="container">

                        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Modify Rewards</h1> <br><br>

                        <?php //Display the current reward image
                        $rewardImage = $row['rewardImagePath'];
                        echo "<input type='image' height='400' width='300' class='img-fluid img-thumbnail' alt='Submit' src='data:image/jpeg;base64," . base64_encode($rewardImage) . "'/>";
                        ?> 


                        <br>
						<form name="myForm" action="modifyDeactivatedRewardFunct.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="rewardID">RewardID</label>
                            <input type="text" class="form-control" value="<?php echo $rewardID; ?>"  placeholder="Enter Reward ID" disabled>
                            <input type="text" class="form-control" id="rewardID" name="rewardID" value="<?php echo $rewardID; ?>"  placeholder="Enter Reward ID" hidden>
                            <small class="form-text text-muted">Reward ID is fixed</small>
                        </div>
                        <div class="form-group">
                            <label for="rewardName">RewardName</label>
                            <input type="text" class="form-control" id="rewardName"  name="rewardName" value="<?php echo $row["rewardName"]; ?>"  placeholder="Enter Reward Name">
                            
                        </div>

                        <div class="form-group">
                            <label for="rewardPoints">Reward Points</label>
                            <input type="number" class="form-control" value="<?php echo $row["rewardPoints"]; ?>" name="rewardPoints" min="1" max="50">
                            <small class="form-text text-muted">Indicate points ranging from 1 - 50</small>
                        </div>			

                        <div class="form-group">
                            <label for="rewardDescription">Reward Description</label>
                            <textarea type="text" type="text" rows="3" class="form-control" id="rewardDescription" name="rewardDescription" placeholder="Enter reward description"><?php echo $row["rewardDescription"]; ?></textarea>	
                        </div> 

                        <div class="form-group">
                            <label for="rewardContactInfo">Contact Information</label>
                            <input type="text" class="form-control" id="rewardContactInfo" value="<?php echo $row["rewardContactInfo"]; ?>" name="rewardContactInfo" placeholder="Enter Merchant Contact Information [Optional]">
                        </div>

                        <div class="form-group">
                            <label for="rewardImgUpload">Upload reward image</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="rewardImagePath" name="rewardImagePath">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                      
						<button type="submit" name="submit" value="activate" class="btn btn-success">Re-activate</button>

                    </div>
                </form>


                <?php
                $count++;
            }
            //echo $count++. " results shown"; 
            echo "</table>";
        } else {
            echo "No result";
        }
        $db->close();
        ?>

        <!-- /.container -->
    </body>
</html>
