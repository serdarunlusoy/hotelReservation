<?php
session_start();
include_once 'mysqli_connect.php';

$hotel_id = $_GET['hotel_id'];
if (isset($hotel_id))
    $_SESSION['hotel_id'] = $hotel_id;

if(isset($_SESSION['usr_id']))
    $user_id = $_SESSION['usr_id'];


$hotel_data = mysqli_query($connection, "SELECT * FROM hotels
      WHERE (`RegistrationId` = '" . $hotel_id . "')") or die(mysql_error());


while ($cols = mysqli_fetch_array($hotel_data)) {
    $daily_price = $cols['DailyPrice'];
}


if (isset($_POST['TotalPrice'])) {
    $People = $_POST['People'];
    $RoomAmount = $_POST['RoomAmount'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $days = round(abs(strtotime($EndDate) - strtotime($StartDate)) / 86400);
    $total = $People * $RoomAmount * $daily_price * $days;
    $_SESSION['Price'] = $total;
}else {
    $People = "";
    $RoomAmount = "";
    $StartDate = "";
    $EndDate = "";
    $total = "0";
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Registration</title>
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
        <!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->


    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 well">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="reservation">
                    <fieldset>
                        <legend>Reservation</legend>

                        <div class="form-group">
                            <label for="name">People</label>
                            <input type="text" name="People" placeholder="People" value="<?php echo $People ?>" required  class="form-control" />  

                        </div>

                        <div class="form-group">
                            <label for="name">Room Amount</label>
                            <input type="text" name="RoomAmount" placeholder="Room Amount" value="<?php echo $RoomAmount ?>" required class="form-control" />

                        </div>

                        <div class="form-group">
                            <label for="name">Start Date</label>
                            <input type="date" name="StartDate" placeholder="Start Date" value="<?php echo $StartDate ?>" required class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="name">End Date</label>
                            <input type="date" name="EndDate" placeholder="End Date" value="<?php echo $EndDate ?>"required class="form-control" />
                        </div>



                        <div class="form-group">
                            <center>  <input type="submit" formaction="reservation_page.php?hotel_id=<?php echo $hotel_id ?>" name="TotalPrice" value="Total Price" class="btn btn-primary"   /></center>
                            <!--<center>  <label for="name"</label><?php echo $total ?></center>-->
                            <!--<center> <input type="textbox" name="Price" placeholder="0" value="<?php echo $total ?>" class="form-control" style="text-align:center;" disabled />-->
                        </div>



                        <div class="form-group">
                            <center> <input type="text" name="Price" placeholder="0" value="<?php echo $total ?>" class="form-control" style="text-align:center;" disabled />
                                <?php
                                if (!isset($_SESSION['usr_id'])) {
                                    echo '<center><label>You need to login to make reservation</label></center>';
                                    echo '<center>  <input type="submit" name="Reservation" value="Rezerve et" formaction="reservation_page_process.php"  class="btn btn-primary disabled" /></center>';
                                } else
                                    echo '<center>  <input type="submit" name="Reservation" value="Rezerve et" formaction="reservation_page_process.php"  class="btn btn-primary" /></center>';
                                ?>

                        </div>



                    </fieldset>


            </div>
        </div>


        </body>
        </html>
