<?php 

require "../dbconnection/dbconnection.php";

//global variable 
$firstnameErr = $lastnameErr = $passwordErr = $emailErr = $contactErr =
        $newPasswordErr = $confirmPasswordErr = $update_status = "";

class userValidate{
    function hashpwd($value){//hash function for password
    $options = [
    'cost' => 12,
    ];
    $value = password_hash($value, PASSWORD_BCRYPT, $options);
    return $value;
    }

    function validateFirstName($u_firstname){
        global $firstnameErr;
        $errorStatus = True;
        if (empty($u_firstname)) {   
            $firstnameErr = "First name is required.";
            $errorStatus = False;
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/",$u_firstname)) {
                $firstnameErr = "Only letters and white space allowed";
                $errorStatus = False;
            }
        }
        return $errorStatus;
    }

    function validateLastName($u_lastname){
        global $lastnameErr;
        $errorStatus = True;
        if (empty($u_lastname)) {   
            $lastnameErr = "Last name is required.";
            $errorStatus = False;
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/",$u_lastname)) {
                $lastnameErr = "Only letters and white space allowed";
                $errorStatus = False;
            }
        }
        return $errorStatus;
    }

    function validateEmail($u_email){
        global $emailErr;
        $errorStatus = True;
        if (empty($u_email)) {   
            $emailErr = "Email is required.\n";
            $errorStatus = False;
        } else {
            if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $errorStatus = False;
            }
        }
        return $errorStatus;
    }

    function validatePhoneNo($u_contact){
        global $contactErr;
        $errorStatus = True;
        if (empty($u_contact)) {   
            $contactErr = "Contact is required.\n";
            $errorStatus = False;
        } else {
            if (!preg_match("/^[0-9]{8}$/",$u_contact)) {
                $contactErr = "Contact number must contains 8 digits";
                $errorStatus = False;
            }
        }
        return $errorStatus;
    }

    function checkPassword($u_currentPassword,$password){
        //$h_currentPassword refers to user entered current password as hash
        //$password refers to hashed password in database
        global $passwordErr;
        $errorStatus = TRUE;
         if (empty($u_currentPassword)) {   
            $passwordErr = "Password is required.\n";
            $errorStatus = False;
        } else {
            //if condition to check currentPassword as a hash value matches the hash value fetch form mysql

            if(!password_verify($u_currentPassword,$password)){ //hash is pesudo
                $passwordErr = "Password does not match.\n";
                $errorStatus = False;
            }
        }
        return $errorStatus;
    }

    function checkNewPassword($u_newPassword,$u_passwordConfirm){
        global $newPasswordErr;
        $errorStatus = True;
        if (!empty($u_newPassword)) {   
            if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$u_newPassword)) {
                $newPasswordErr = "Minimum 8 characters, at least 1 letter and 1 number.";
                $errorStatus = False;
            }
            if (empty($u_passwordConfirm)) {
                $confirmPasswordErr = "Confirm Password is required to change password.\n";
                $errorStatus = False;
            } else {
                if ( $u_passwordConfirm != $u_newPassword){
                  $confirmPasswordErr = "Confirm password must match new password";
                  $errorStatus = False;
                }
            }
        }
        return $errorStatus;
    }

    function checkEmail($u_email){
        $conn = DBconnection::getmysqli();
        global $emailErr;
        $errorStatus = True;
        $stmt = $conn->prepare("SELECT userid FROM user WHERE email = ?");
        $stmt->bind_param('s', $u_email); // this should be session user id (remove this comment)
        $stmt->execute();
        $stmt->bind_result($duplicateID);
        $stmt->fetch();
         if(!empty($duplicateID)){
            $errorStatus = False;
            $emailErr = "Email in use";
        }
        $stmt->close();
        $conn->close();
        return $errorStatus;
    }

    function checkContact($u_contact){
        $conn = DBconnection::getmysqli();
        global $contactErr;
        $errorStatus = True;
        $stmt = $conn->prepare("SELECT userid FROM user WHERE contact = ?");
        $stmt->bind_param('i', $u_contact); // this should be session user id (remove this comment)
        $stmt->execute();
        $stmt->bind_result($duplicateID);
        $stmt->fetch();
        if(!empty($duplicateID)){
            $errorStatus = False;
            $contactErr = "Contact in use";
        }
        $stmt->close();
        $conn->close();
        return $errorStatus;
    }
}

?>