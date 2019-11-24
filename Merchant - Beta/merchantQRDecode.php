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
					<form name="myForm" action="merchantQRDecodeFunct.php" method="post" enctype="multipart/form-data">
					<div class="container">
						
						<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Scan QR - MERCHANT</h1> <br><br>
						
						
						
						<div class="form-group">
							<label for="rewardContactInfo">Contact Information</label>
							<input type="text" class="form-control" id="qrcontent" name="qrcontent" placeholder="Enter QR code scanned data here">
						</div>
						
						<button type="submit" value="Submit" name="Submit" class="btn btn-primary">Submit</button>
						
					</div>
					</form>

<!-- /.container -->
    </body>
</html>
