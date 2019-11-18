<?php

class userView{
    
    function viewParticulars(){
        $conn = DBconnection::getmysqli();
        global $currentUserID; //chg to session
        global $userID, $firstname, $lastname, $username, $password, $gender,$dateofbirth,$email,$contact;
        $stmt = $conn->prepare("SELECT * FROM user WHERE userid = ?");
        $stmt->bind_param('i', $currentUserID); // this should be session user id (remove this comment)
        $stmt->execute();
        $stmt->bind_result($userID, $firstname, $lastname, $username, $password, $gender,$dateofbirth,$email,$contact);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
    }

    function view_password_email_contact_particulars(){
        $conn = DBconnection::getmysqli();
        global $currentUserID;
        $stmt = $conn->prepare("SELECT password,email,contact FROM user WHERE userid = ?"); #required for checks
        $stmt->bind_param('i', $currentUserID);
        $stmt->execute();
        $stmt->bind_result($password,$email,$contact);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
        return array($password,$email,$contact);
    }
}

?>
