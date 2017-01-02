<?php

$servername = "localhost";
$username = "root";
$password = "";
<<<<<<< HEAD
$dbname = "hrsdb";
=======
$dbname = "HRSdb";
>>>>>>> c1cda85e51226ed3e733ba32bfc36ae4129fb54e

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
