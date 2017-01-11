<?php
session_start();
include_once 'mysqli_connect.php';

  $hotel_id = $_GET['hotel_id'];

  

  $hotel_data = mysqli_query($connection,"SELECT * FROM hotels
      WHERE (`RegistrationId` = '".$hotel_id."')") or die(mysql_error());

  while($cols = mysqli_fetch_array($hotel_data)){
    $daily_price = $cols['DailyPrice'];
  }
    $People=$_POST['People'];
    $RoomAmount=$_POST['RoomAmount'];
    $StartDate=$_POST['StartDate'];
    $EndDate=$_POST['EndDate'];
   $days= round(abs(strtotime($EndDate)-strtotime($StartDate))/86400);
    $total=$People*$RoomAmount*$daily_price*$days;
  		
  		
							
  

if (isset($_POST['Reservation'])) {
    $People = mysqli_real_escape_string($connection, $_POST['People']);
    $RoomAmount = mysqli_real_escape_string($connection, $_POST['RoomAmount']);
    $StartDate = mysqli_real_escape_string($connection, $_POST['StartDate']);
    $EndDate = mysqli_real_escape_string($connection, $_POST['EndDate']);
    
   


    if (!$error) {
        if (mysqli_query($connection, "INSERT INTO reservations(People,RoomAmount,StartDate,EndDate,Price) VALUES('" . $People . "', '" . $RoomAmount . "','" . $StartDate . "','" . $EndDate . "','" . $Price . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error";
        }
    }
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

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">HRS</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="#">Hotels</a></li>
                    <li><a href="#">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 well">
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="reservation">
                    <fieldset>
                        <legend>Reservation</legend>

                        <div class="form-group">
                            <label for="name">People</label>
                            <input type="text" name="People" placeholder="People" required value="" class="form-control" />  
                            
                        </div>

                        <div class="form-group">
                            <label for="name">Room Amount</label>
                            <input type="text" name="RoomAmount" placeholder="Room Amount" required class="form-control" />

                        </div>

                        <div class="form-group">
                            <label for="name">Start Date</label>
                            <input type="date" name="StartDate" placeholder="Start Date" required class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="name">End Date</label>
                            <input type="date" name="EndDate" placeholder="End Date" required class="form-control" />
                        </div>
                        	
                      

                        <div class="form-group">
                            <center>  <input type="submit" formaction="reservation_page.php?hotel_id=<?php echo $hotel_id ?>" name="Total Price" value="Total Price" class="btn btn-primary"   /></center>
                        </div>
                        
                        <div class="form-group">
                            <center>  <label id="calc" for="name"></label><?php echo $total ?></center>
                        </div>
                        
                        <div class="form-group">
                            <center>  <input type="submit" name="Reservation" value="Reservation" class="btn btn-primary" /></center>
                        </div>
                        
                        
                        
                    </fieldset>


            </div>
        </div>


        </body>
        </html>
