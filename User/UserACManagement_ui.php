<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Smiles4Miles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<header>
    <div class="col-sm-12">
        <h1>Modify Account</h1>
    </div>
</header>

<?php 
    require('UserACManagement.php');
    userView::viewParticulars();
?>
    
<article class="container-fluid">

    <section>
        <form class="col-lg-6 form-horizontal" id="UserManageProfile" name="UserManageProfile" action="UserACManagement_ui.php" method="POST">
            <div class="col-sm-12">
                    <label class="control-label"><?php echo $update_status ?></label>
                </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="control-label">Username: </label>
                    <label class="control-label"><?php echo $username ?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                <label for="fname" >First Name: <?php echo $firstnameErr ?> </label>
                    <!--<input type="text" name="fname" class="form-control" id="fname" placeholder=<?php echo $firstname?>>-->
                    <input type="text" name="fname" class="form-control" id="fname" value=<?php echo $firstname?>>

                </div>
            </div>
            <div class="form-group">
                <label for="lname" class="col-sm-6 control-label">Last Name: <?php echo $lastnameErr ?> </label>
                <div class="col-sm-6">
                    <!--<input type="text" name="lname" class="form-control" id="lname" placeholder=<?php echo $lastname?>>-->
                    <input type="text" name="lname" class="form-control" id="lname" value=<?php echo $lastname?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <label class=" control-label">DOB: </label>
                    <label class=" control-label"><?php echo $dateofbirth?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-6 control-label">Email: <?php echo $emailErr ?> </label>
                <div class="col-sm-6">
                    <!--<input type="email" name="email" class="form-control" id="email" placeholder=<?php echo $email?>>-->
                    <input type="email" name="email" class="form-control" id="email" value=<?php echo $email?>>
                </div>
            </div>
            <div class="form-group">
                <label for="contact" class="col-sm-6 control-label">Phone Number: <?php echo $contactErr ?> </label>
                <div class="col-sm-6">
<!--                    <input type="text"  pattern="\d{8}" autofocus required title="Please enter 8 digit"
                           name="phone" class="form-control" id="phone" placeholder=<?php echo $contact?>>-->
                    <input type="text"  pattern="\d{8}" autofocus required title="Please enter 8 digit"
                           name="contact" class="form-control" id="contact" value=<?php echo $contact?>>
                </div>
            </div>
            <div class="form-group">
                <label for="currentPassword" class="col-sm-6 control-label">Current Password: <?php echo $passwordErr ?> </label>
                <div class="col-sm-6">
                    <input type="password" name="currentPassword" class="form-control" id="currentPassword" placeholder="Current Password">
                </div>
            </div>
            <div class="form-group">
                <label for="newPassword" class="col-sm-6 control-label">New Password: <?php echo $newPasswordErr ?> </label>
                <div class="col-sm-6">
                    <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="Enter value to change password">
                </div>
            </div>
             <div class="form-group">
                <label for="passwordConfirm" class="col-sm-6 control-label">Confirm Password: <?php echo $confirmPasswordErr ?></label>
                <div class="col-sm-6">
                    <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm" placeholder="Confirm change password">
                </div>
            </div>
            <div class="">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn-default" id="submit" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </section>
</article>
</body>
</html>