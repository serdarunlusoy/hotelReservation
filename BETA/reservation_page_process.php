<?php
session_start();
include_once 'mysqli_connect.php';


if (!isset($_SESSION['usr_id'])) {
    header("Location: login.php");
}

$hotel_id = $_SESSION['hotel_id'];

    $People = mysqli_real_escape_string($connection, $_POST['People']);
    $RoomAmount =mysqli_real_escape_string($connection, $_POST['RoomAmount']);
    $StartDate = mysqli_real_escape_string($connection, $_POST['StartDate']);
    $EndDate = mysqli_real_escape_string($connection, $_POST['EndDate']);
    $total = mysqli_real_escape_string($connection, $_SESSION['Price']);
    $hotel_id = mysqli_real_escape_string($connection, $_SESSION['hotel_id']);
    $user_id = mysqli_real_escape_string($connection, $_SESSION['usr_id']);
    
    
    
    
        if (mysqli_query($connection, "INSERT INTO reservations(People,RoomAmount,StartDate,EndDate,Price,Hotels_RegistrationId,users_userId) VALUES('" . $People . "', '" . $RoomAmount . "','" . $StartDate . "','" . $EndDate . "','" . $total . "','" . $hotel_id . "','" . $user_id . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error";
        }
    