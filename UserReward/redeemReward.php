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
		include '../AdminReward/rewardManagement.php';
        $rewardID = $_POST['rewardID']; //rewardID selected by the previous page ("userViewReward.php")
		$result = listSelectedReward($rewardID);

        $count = 0;

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                ?>

                <!-- Page Content -->
                
                    <div class="container" > 

                        <h1 class="font-weight-bold text-center text-lg-center mt-4 mb-0">Redeem Reward</h1> <br><br>
						<h3 class="font-weight-light text-center text-lg-center col-12 mt-2 mb-2">
						<center><div id='rewardName'><?php 	echo $row["rewardName"]; ?></div></center>
						
						</h3>
			
                        <?php //Display the current reward image
                        $rewardImage = $row['rewardImagePath'];
                        echo "<input type='image' height='200' width='200' class='rounded mx-auto d-block' alt='Submit' src='data:image/jpeg;base64," . base64_encode($rewardImage) . "'/>";
                        ?> 

                        <br>
						<form name="myForm" action="redeemRewardFunct.php" method="post" onsubmit="return confirm('Are you sure you want to redeem this reward?')" enctype="multipart/form-data">
						<input type="text" class="form-control" id="rewardID" name="rewardID" value="<?php echo $rewardID; ?>"  hidden>   
						
                        <div class="w-50 p-3 mx-auto"  style="background-color: #eee;">
							<div class="card-body">
							<h5 class="text-center"> -<?php echo $row["rewardPoints"]; ?> points required-</h5>
							</div>
 							<div class="card-body">
								<h5 class="text-center"> - Description - </h5>
								<p class="text-center"><?php echo $row["rewardDescription"]; ?></p>
							</div>
                            <div class="card-body">
								<h5 class="text-center"> - Contact Information - </h5>
								<p class="text-center"><?php echo $row["rewardContactInfo"]; ?></p>
							</div>
							<button type="submit" name="submit" value="submit" class="btn btn-primary center-block" >Redeem</button>
						</div> 
                        
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
