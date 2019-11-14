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
					<form name="myForm" action="addRewardFunct.php" method="post" enctype="multipart/form-data">
					<div class="container">
						
						<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Add Rewards</h1> <br><br>
						
						<div class="form-group">
							<label for="rewardID">RewardID [auto-generated]: </label>
							<h2><?php include 'rewardManagement.php'; echo retrieveLastRewardID(); ?></h2>
						</div>
						<div class="form-group">
							<label for="rewardName">RewardName</label>
							<input type="text" class="form-control" id="rewardName" name="rewardName" placeholder="Enter Reward Name" required>
								<small class="form-text text-muted">Reward Name is required</small>
						</div>
						
						<div class="form-group">
							<label for="rewardPoints">Reward Points</label>
							<input type="number" class="form-control" name="rewardPoints" min="1" max="50" required>
							<small class="form-text text-muted">Indicate points ranging from 1 - 50</small>
						</div>			
						
						<div class="form-group">
							<label for="rewardDescription">Reward Description</label>
							<textarea type="text" type="text" rows="3" class="form-control" id="rewardDescription" name="rewardDescription" placeholder="Enter reward description" required></textarea>	
						</div> 
						
						<div class="form-group">
							<label for="rewardContactInfo">Contact Information</label>
							<input type="text" class="form-control" id="rewardContactInfo" name="rewardContactInfo" placeholder="Enter Merchant Contact Information [Optional]">
						</div>
						
						<div class="form-group">
							<label for="rewardImgUpload">Upload reward image</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="rewardImagePath" name="rewardImagePath"  required>
								<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
							</div>
						</div>
						<button type="submit" value="Submit" class="btn btn-primary">Submit</button>
						
					</div>
					</form>

<!-- /.container -->
    </body>
</html>
