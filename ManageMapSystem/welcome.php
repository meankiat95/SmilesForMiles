<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Smiles4Miles - Admin</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="jquery.min.js"></script> 
        
        <style type="text/css">
	body {
            color: #fff;
            background: #d47677;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:hover {
            background-color: #F08080;
        }       
    </style>

    </head>
    <body>     
        <!-- Header of the page -->
        
        <div class="page-header" align="center">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Smiles for Miles Administrator site.</h1>
        </div>
        <p align="right">
            <a href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
        
        <table>
            <tr bgcolor="#000000">
                <th>Id</th>
                <th>Address</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Type</th>
                <th>Actions</th>
                <th>Remarks</th>
            </tr>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "smiles4miles";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT locationID, address, latitude, longitude, type, remarks FROM indicatelocation";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["locationID"]. "</td><td>" . $row["address"] . "</td><td>"
                    . $row["latitude"]. "</td><td>".$row["longitude"]."</td><td>".$row["type"]."</td>";
                    echo '<td><button id="update" type="submit" class="btn btn-link" onclick="addFunction()"><span class="glyphicon glyphicon-ok"></span></button> '
                    . '<button id="delete" type="submit" class="btn btn-link" onclick="delFunction()"><span class="glyphicon glyphicon-remove"></span></button>';

                    if($row["remarks"] == "verified"){
                       echo "<td>verified</td>"; 
                    }
                    else{
                        echo "<td>pending</td>";
                    }            
                                 
                }
                                
                echo "</tr></table>";
                } else { echo "0 results"; }
                                
                $conn->close();
            ?>    
        </table>   
        <script>
            function addFunction(){
                document.getElementById("update").innerHTML = "updated";
            }
            
            function delFunction(){
                document.getElementById("delete").innerHTML = "deleted";
            }
        </script>
    </body>
</html>
