<?php
  session_start();
  include_once 'mysqli_connect.php';

  $hotel = $_GET['hotel_id'];

  $hotel_data = mysqli_query($connection,"SELECT * FROM hotels
      WHERE (`RegistrationId` = '".$hotel."')") or die(mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
  <title>HRS - results page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>






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
                    <?php } else { ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
<!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->

<?php

while($cols = mysqli_fetch_array($hotel_data)){

$hotel_info = $cols['HotelInfo'];

$pic1 = base64_encode($cols['Picture1']);
$pic2 = base64_encode($cols['Picture2']);




}



?>



<div class="container">
  <div class="row">

    <div class="col-sm-4">

     <div id="myCarousel" class="carousel slide" data-ride="carousel" style=" height: 300px;">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  </ol>

  <!-- Slide Wrapper -->
  <div class="carousel-inner" role="listbox">

    <div class="item active" style="width: auto;height: 400px;">
    <?php
    echo '<img src="data:image/jpeg;base64,'.$pic1.'"/>';
    ?>
    </div>

    <div class="item">
    <?php
    echo '<img src="data:image/jpeg;base64,'.$pic2.'"/>'; 
    ?>
    </div>

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background-image:none">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background-image:none">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>


    <!-- Results Panel -->
    <div class="col-sm-8">
       <div class="panel panel-default">

        <div class="panel-heading"> Hotel Info </div>
        <div class="panel-body">
          <?php

          echo  $hotel_info;

          ?>



        </div>
        <div class="panel-heading"> More Hotel Info </div>
        <div class="panel-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

        </div>
      </div>

    </div>
  </div>
  </div>
</div>


</body>
</html>
