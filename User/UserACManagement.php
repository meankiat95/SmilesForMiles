<?php
require "UserControl.php";
require "../Security/security.php";
require "UserManageProfile.php";

class updateValidator{

    function validator($u_firstname,$u_lastname,$u_email,$u_contact,$u_newPassword,$u_passwordConfirm,$u_currentPassword){
        $PEC = userView::view_password_email_contact_particulars();
        $password = $PEC[0];
        $email = $PEC[1];
        $contact = $PEC[2];

        $errorStatusFN = userValidate::validateFirstName($u_firstname);
        $errorStatusLN = userValidate::validateLastName($u_lastname);
        $errorStatusE = userValidate::validateEmail($u_email);
        $errorStatusPN = userValidate::validatePhoneNo($u_contact);
        $errorStatusNP = userValidate::checkNewPassword($u_newPassword,$u_passwordConfirm);
        $errorStatusP = userValidate::checkPassword($u_currentPassword, $password);

        //check for duplicate
        if($email != $u_email){
            $errorStatusCE = userValidate::checkEmail($u_email);
        }else{
            $errorStatusCE = TRUE;
        }

        if($contact != $u_contact){
            $errorStatusCC = userValidate::checkContact($u_contact);
        }else{
            $errorStatusCC = TRUE;
        }

        if ($errorStatusFN && $errorStatusLN && $errorStatusE && $errorStatusPN &&
                $errorStatusNP && $errorStatusP && $errorStatusCE && $errorStatusCC){
            $errorStatus = TRUE;
        }else{
            $errorStatus = FALSE;
        }

        return $errorStatus;
    }
}


if (isset($_POST['submit'])) {
    //need escape sql, due to sql statement usage.
    $u_email = security::sanitize($_POST['email']);
    $u_contact = security::sanitize($_POST['contact']);
    $u_firstname= security::sanitize($_POST['fname']);
    $u_lastname = security::sanitize($_POST['lname']);
    $u_newPassword =  security::sanitize($_POST['newPassword']);
    $u_passwordConfirm = security::sanitize($_POST['passwordConfirm']);
    $u_currentPassword = security::sanitize($_POST['currentPassword']);

    $errorStatus = updateValidator::validator($u_firstname,$u_lastname,$u_email,$u_contact,$u_newPassword,$u_passwordConfirm,$u_currentPassword);

    //validated to be account owner thorugh entering current password
    if ($errorStatus == True){
        $conn = DBconnection::getmysqli();
        //start of sql
        if (empty($u_newPassword)){ #update account without a new password
        $stmt = $conn->prepare("update user set firstname = ?, lastname = ?, email = ?, contact = ? where userID = ?");
        $stmt->bind_param("sssss",$u_firstname,$u_lastname,$u_email,$u_contact,$currentUserID);
        }
        elseif (!empty($u_newPassword)){ #update account without a new password
        $h_newPassword = hashpwd($u_newPassword);
        $stmt = $conn->prepare("update user set firstname = ?, lastname = ?, email = ?, contact = ?, password = ? where userID = ?");
        $stmt->bind_param("ssssss",$u_firstname,$u_lastname,$u_email,$u_contact,$h_newPassword,$currentUserID);
        }
        if($stmt->execute()){
        $update_status = "Update successful";
        }else{
        $update_status = "Update failed";
        }
        $stmt->close();
        $conn->close();
    }
}



