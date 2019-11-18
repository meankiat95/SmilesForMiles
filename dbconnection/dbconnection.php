<?php

class dbconnection{

    public static function getmysqli()
    {
        $servername = "127.0.0.1:3306";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "smiles4miles";
        // Create connection
        $conn = mysqli_init();
        $conn->connect($servername, $dbusername, $dbpassword,$dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

}

$currentUserID = 1; // replace with session

?>
