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
			include 'rewardRedemption.php';
			#$user = $_SESSION['user'];
			#$userID = $user->userID;
				$userID ='123';
				$currentPoints = getUserGamePoints($userID);
                ?>

                <!-- Page Content -->
                
                    <div class="container" > 

                        <h1 class="font-weight-bold text-center text-lg-center mt-4 mb-0">GameProfile</h1> <br><br>
						<h3 class="font-weight-light text-center text-lg-center col-12 mt-2 mb-2">
						<center><div id='rewardName'>You have <?php 	echo $currentPoints; ?> points currently.</div></center>
						
						</h3>
					</div>
                     


               

        <!-- /.container -->
    </body>
</html>
