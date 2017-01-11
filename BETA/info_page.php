<?php
  session_start();
  include_once 'mysqli_connect.php';

  $hotel = $_GET['hotel_id'];

  $hotel_data = mysqli_query($connection,"SELECT * FROM hotels
      WHERE (`RegistrationId` = '".$hotel."')") or die(mysql_error());

  $hotel_details_data = mysqli_query($connection,"SELECT * FROM hotel_details
      WHERE (`Hotels_RegistrationId` = '".$hotel."')") or die(mysql_error());


while($cols = mysqli_fetch_array($hotel_data)){

$hotel_name =  $cols['HotelName'];
$hotel_info =str_replace("\n", "</p><p>", $cols['HotelInfo']);
$hotel_city = $cols['City'];
$hotel_province = $cols['Province'];
$hotel_country = $cols['Country'];
$daily_price = $cols['DailyPrice'];
$hotel_stars = $cols['Stars'];
$hotel_phone = $cols['Phone'];

$pic1 = base64_encode($cols['Picture1']);
$pic2 = base64_encode($cols['Picture2']);
}

while($cols = mysqli_fetch_array($hotel_details_data)){

$has_pool =  $cols['Pool'];
$has_park = $cols['Park'];
$allow_pets =$cols['Pets'];
$has_internet = $cols['Internet'];
$has_parking = $cols['Parking'];
$languages = explode(' ',$cols['Languages']);

}

function has_detail($detail){
     if ($detail == 0) {echo "<i class='glyphicon glyphicon-remove'></i>";}
     else {echo "<i class='glyphicon glyphicon-ok'></i>";}}
?>

<!DOCTYPE html>
<html>
<head>
  <title>HRS - "<?php echo $hotel_name; ?>"</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style> #reservation_button { 
          width: 100%; 
          margin:10px 0px 10px 0px;
          padding:10px 0px 10px 0px;
          font-size:19px;}
  </style>



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

<div class="container">
  <div class="row">
    <div class="col-sm-4">
<!--CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL CAROUSEL -->
     <div id="myCarousel" class="carousel slide" data-ride="carousel" style=" height: 200px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  </ol>
  <!-- Slide Wrapper -->
  <div class="carousel-inner" role="listbox">
    <div class="item active" style="width: auto;height: 400px;">
    <?php echo '<img src="data:image/jpeg;base64,'.$pic1.'"/>'; ?>
    </div>
    <div class="item">
    <?php echo '<img src="data:image/jpeg;base64,'.$pic2.'"/>'; ?>
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
<!--CAROUSEL END CAROUSEL END CAROUSEL END CAROUSEL END CAROUSEL END CAROUSEL END CAROUSEL END CAROUSEL -->

<!--DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS DETAILS -->

<button id="reservation_button" class="btn btn-success">Make a Reservation <b>NOW!</b></button>
<div class="panel panel-default">
  <div class="panel-heading"><b>Hotel Facilities and Details</b></div>
  <div class="panel-body">
  <ul class="list-group">
  <li class="list-group-item">
  Pool: <?php has_detail($has_pool) ?>
  Park: <?php has_detail($has_park) ?>
  Pets: <?php has_detail($allow_pets) ?> <p></p>
  Internet: <?php has_detail($has_internet) ?>
  Parking Lot: <?php has_detail($has_parking) ?>
  </li>
  <li class="list-group-item"> <span class="glyphicon glyphicon-earphone"> </span>
  <b>Phone: </b><?php echo $hotel_phone; ?>
  </li>
  <li class="list-group-item">
  <b>Spoken Languages:</b> <p></p><span style="font-weight:none;">
  <?php 

    foreach($languages as $language){
      echo "<i class='glyphicon glyphicon-triangle-right'></i> ".$language."<p></p>";
    }

   ?></span>
  </li>
  </ul>
  </div>
</div>
<!--DETAILS END DETAILS END DETAILS END DETAILS END DETAILS END DETAILS END DETAILS END DETAILS END -->

</div>



    <!-- Results Panel -->
    <div class="col-sm-8">
       <div class="panel panel-default">
       <div class="panel-heading"> <b>Hotel Summary</b> </div>
        <div class="panel-body">
        <b>Stars: </b>
        <span class="badge" style="background-color: #777;color: #FFE142;font-size:110%; margin-right:20px">
        <?php echo str_repeat("<span class='glyphicon glyphicon-star'></span>",$hotel_stars);  ?>
        </span>
        <b>Location: </b><?php echo $hotel_city.", ".$hotel_country;  ?>
        <div style="float: right; font-size:19px"><b> Daily Price: <span class="glyphicon glyphicon-euro"></span><?php echo $daily_price; ?></b>
        </div>
        </div>

        <div class="panel-heading"> <b>Hotel Info</b> </div>
        <div class="panel-body">
          <?php echo  $hotel_info; ?>
        </div>
    </div>
  </div>
  </div>
</div>


</body>
</html>
