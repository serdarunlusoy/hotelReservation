<?php
session_start();
include_once 'mysqli_connect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: login.php");
}
   $hotel_id = $_SESSION['hotel_id'];

$hotel_data = mysqli_query($connection, "SELECT * FROM hotels
      WHERE (`RegistrationId` = '" . $hotel_id . "')") or die(mysql_error());


while ($cols = mysqli_fetch_array($hotel_data)) {
    $Hotel_Name = $cols['HotelName'];
}

   
$user_id = $_SESSION['usr_id'];

$reservation_data = mysqli_query($connection, "SELECT * FROM reservations
      WHERE (`users_userId` = '" . $user_id  . "')") or die(mysql_error());


while ($cols = mysqli_fetch_array($reservation_data)) {
    $People = $cols['People'];
    $RoomAmount =$cols['RoomAmount'];
    $StartDate = $cols['StartDate'];
    $EndDate =$cols['EndDate'];
    $Price = $cols['Price'];
    $HotelsId =$cols['Hotels_RegistrationId'];
    
}

?>
<!DOCTYPE html>
<html>
    <head>
    <title>HRS - User Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <!--NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  NAVBAR  -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">HRS</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Profile</a></li>     
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_email']; ?></p></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Log Out</a></li>
                        <li><a href="userpage.php.php"><span class="glyphicon glyphicon-user"> </span> Profile</a></li>
                    <?php } else { ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        
                    <?php } ?>
                </ul>
            </div>
        </nav>
<!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->

    <!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->

        
         <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 well">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="reservation">
                    <fieldset>
                        <legend>Reservation List</legend>

                        <div class="form-group">
                           <br> <label for="name">People: <?php echo $People ?> </label></br>
                           <br> <label for="name">Hotel Name : <?php echo $Hotel_Name ?> </label></br>
                           <br> <label for="name">Room Amount : <?php echo $RoomAmount ?> </label></br>
                           <br> <label for="name">Start Date : <?php echo $StartDate ?> </label></br>
                           <br> <label for="name">End Date : <?php echo $EndDate ?> </label></br>
                           <br><input type="submit" name="Delete" value="Delete reservation" class="btn btn-primary" /></br>
                            
                        </div>
                    </fieldset>


            </div>
        </div>
        
        
</body>
</html>
