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
        <!-- Page Content -->
        <div class="container">
		
			<h1> ---Admin Reward Management---</h1>

            <hr class="mt-2 mb-5">
			
            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Current Active [Rewards]</h1>

            <hr class="mt-2 mb-5">
			
            <div class="row text-center text-lg-left">
				
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                    </a>
                 </div>                
            
            
                <?php
				include 'rewardManagement.php';

				$result = listAllActivatedRewards();
                $count = 0;
                
                if ($result->num_rows > 0) {

                while ($row = $result ->fetch_assoc()) {

                    $rewardImage = $row['rewardImagePath'];
                echo "<div class='col-lg-3 col-md-4 col-6'><form action='modifyRewards.php' method='post'> 
                        <a class='d-block mb-4 h-100'>
                        <input type='image' style='height:200px;width:300px;object-fit:contain;' class='img-fluid img-thumbnail' alt='Submit' src='data:image/jpeg;base64,".base64_encode($rewardImage)."'/>
                            <input type='hidden' name='rewardID' value='" . $row["rewardID"] . "'>
                            <div>[" . $row["rewardID"] ."] ". $row["rewardName"] . "</div>
                                </a>
                             </form></div>";

                    $count++;

                }
                //echo $count++. " results shown"; 
                echo "</table>";
                } else {
                echo "No result";
                }
                $db->close();

                ?>
            </div>
			<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"></h1>
			<hr class="mt-2 mb-5">
			<form action="./viewDeactivatedRewards.php">
			<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Deactivated [Rewards] : <button type="submit" name="submit" value="submit" class="btn btn-primary">Re-Activate</button></h1>
			</form>
			<hr class="mt-2 mb-5">
			
			<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"></h1>
			<hr class="mt-2 mb-5">
			<form action="addRewards.php">
			<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Create new [Rewards] : <button type="submit" name="submit" value="submit" class="btn btn-primary"> Create New</button></h1>
			</form>
			<hr class="mt-2 mb-5">

        </div>
        <!-- /.container -->
    </body>
</html>
