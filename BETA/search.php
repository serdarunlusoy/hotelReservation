<?php
  $connection=mysqli_connect("localhost", "root", "","hrsdb") or die("Error connecting to database: ".mysqli_error());
  
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
<body>

 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">HRS System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
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

    <div class="col-sm-4">




      <div id="custom-search-input" style="padding-bottom:5px">
        <div class="input-group col-md-12">
          <input type="text" class="  search-query form-control" placeholder="Search" />
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">
              <span class=" glyphicon glyphicon-search"></span>
                </button>
              </span>
        </div>
      </div>


      <div class="panel panel-default">

        <div class="panel-heading"> <button type="button" class="btn btn-primary btn-sm btn-block">Advanced Search</button> </div>
        <div class="panel-body">
          <ul class="list-group">
              <li class="list-group-item">HERE</li>
              <li class="list-group-item">BE</li>
              <li class="list-group-item">ADVANCES</li>
              <li class="list-group-item">OPTIONS</li>
          </ul>

        </div>
      </div>

    </div>


<?php
  $query = $_GET['query'];

  $min_length = 3;

  if(strlen($query) >= $min_length){ // if query length > minLen
    $query = htmlspecialchars($query);
    // html conversion

    $query = mysqli_real_escape_string($connection,$query);
    // anti-SQL injection

    $raw_results = mysqli_query($connection,"SELECT * FROM hotels
      WHERE (`HotelName` LIKE '%".$query."%') OR (`District` LIKE '%".$query."%')") or die(mysql_error());

    if(mysqli_num_rows($raw_results) > 0){ // if there are results

      echo "<div class='col-sm-8'>
      <table class='table table-hover' style='max-width: none'>
        <thead>
          <tr>
            <th>Hotel Name</th>
            <th>Hotel Rating</th>
            <th>Hotel Location</th>
            <th>Daily Price</th>
            <th></th>
          </tr>
        </thead>
        <tbody>";

      while($results = mysqli_fetch_array($raw_results)){
      // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

        echo "            <tr class='hotel_result'>
              <td id='hotel_name'>".$results['HotelName']."</td>
              <td id='hotel_type'>".$results['Stars']."</td>
              <td id='hotel_loc'>".$results['District']."</td>
              <td id='hotel_daily_pr'>".$results['DailyPrice']."</td>
              <td id='info_button'><a href='/hotels/".$results['InfoPage']."'class='btn btn-default'>Info Page</a></td>
            </tr>";
      }
      echo "          </tbody>
        </table>
    </div>";

    }
    else{ // if there is no matching rows do following
      echo "No results";
    }

  }
  else{ // if query length is less than minimum
    echo "Minimum length is ".$min_length;
  }
?>


  </div>
</div>


</body>
</html>
