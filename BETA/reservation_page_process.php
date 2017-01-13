<?php
session_start();
include_once 'mysqli_connect.php';


if (!isset($_SESSION['usr_id'])) {
    header("Location: login.php");
}


$hotel_id = $_SESSION['hotel_id'];

$People = mysqli_real_escape_string($connection, $_POST['People']);
$RoomAmount = mysqli_real_escape_string($connection, $_POST['RoomAmount']);
$StartDate = mysqli_real_escape_string($connection, $_POST['StartDate']);
$EndDate = mysqli_real_escape_string($connection, $_POST['EndDate']);
$total = mysqli_real_escape_string($connection, $_SESSION['Price']);
$hotel_id = mysqli_real_escape_string($connection, $_SESSION['hotel_id']);
$user_id = mysqli_real_escape_string($connection, $_SESSION['usr_id']);


echo $People;

?>
<!DOCTYPE html>
<html>
    <head>
    <title>Registration</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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

                </ul>
                <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_email']; ?></p></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> </span> Log Out</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-user"> </span> Profile</a></li>
                        <?php } else { ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php } ?>
                </ul>
            </div>
        </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 well">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="reservation">
                    <fieldset>
                        <center><label>Success Reservation!</label></center>
                        <center><br><input type="submit" name="Delete" value="Continue Main Page !" formaction="index.php" class="btn btn-primary" /></br></center>


                    </fieldset>
                                      <span class="text-success"><?php
                      if (isset($successmsg)) {
                          echo $successmsg;
                      }
                      ?></span>
                  <span class="text-danger"><?php
                      if (isset($errormsg)) {
                          echo $errormsg;
                      }
                      ?></span>


            </div>
        </div>
    </body>
</html>

