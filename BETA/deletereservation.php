<?php
session_start();
include_once 'mysqli_connect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: login.php");
}

$reservationId= $_GET['reservationId'];


mysqli_query($connection, "DELETE FROM reservations WHERE reservationId = '" . $reservationId . "' ");

?>
