<?php
  session_start();
  include_once 'mysqli_connect.php';

  if (isset($_GET['query'])){$query = $_GET['query'];

  $query = htmlspecialchars($query);
    // html conversion

    $query = mysqli_real_escape_string($connection,$query);
    // anti-SQL injection
  } else
  {$query="";}


if (isset($_POST['advSearch']) ){

  $queryList = array();
  if ($_GET['query'] != "") {
    $qQuery="((h.HotelName LIKE '%".$query."%') OR (h.Province LIKE '%".$query."%')
      OR (h.City LIKE '%".$query."%'))"; array_push($queryList, $qQuery);}
  if ($_POST['starCount'] != "") {
    $starCountQuery = "h.Stars=".$_POST['starCount']; array_push($queryList, $starCountQuery);}
  if ($_POST['minPrice'] != "" && $_POST['maxPrice'] != "") {
    $priceQuery = "h.DailyPrice BETWEEN ".$_POST['minPrice']." AND ".$_POST['maxPrice'];
    array_push($queryList, $priceQuery);}
    $detailsQuery = "";
  if (isset($_POST['hasPool'])) {array_push($queryList,"d.Pool=1");}
  if (isset($_POST['hasPark'])) {array_push($queryList,"d.Park=1");}
  if (isset($_POST['hasPets'])) {array_push($queryList,"d.Pets=1");}
  if (isset($_POST['hasInternet'])) {array_push($queryList,"d.Internet=1");}
  if (isset($_POST['hasParking'])) {array_push($queryList,"d.Parking=1");}
  if ($_POST['language'] != "") {
    $languageQuery = "d.Hotels_RegistrationId=h.RegistrationId AND d.Languages REGEXP '".$_POST['language']."'";
    array_push($queryList,$languageQuery);}

  $advQuery ="SELECT DISTINCT h.* FROM hotels h ,hotel_details d WHERE ";
  foreach($queryList as $i) {
    $advQuery = $advQuery.$i." AND ";
  }
  $advQuery = substr($advQuery, 0, -5);

  $raw_results =mysqli_query($connection, $advQuery) or die(mysql_error());
} else{

     $raw_results = mysqli_query($connection,"SELECT h.* FROM hotels h
      WHERE (h.HotelName LIKE '%".$query."%') OR (h.Province LIKE '%".$query."%')
      OR (h.City LIKE '%".$query."%')") or die(mysql_error());
}


header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
  <title>HRS - Search results for "<?php echo $query; ?>"</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>.num-inp{max-width:50px;}</style>

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


    <!--SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH SEARCH -->
    <form action="search.php" method="GET">
          <div id="custom-search-input" style="padding-bottom:20px;">
              <div class="input-group col-sm-12">
                  <input id="srch" type="text" name="query" value="" class="search-query form-control" placeholder="Search" />
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
                  </span>
              </div>
          </div>
      </form>
      <!--SEARCH END SEARCH END SEARCH END SEARCH END SEARCH END SEARCH END SEARCH END SEARCH -->

      <script type="text/javascript">
      function retrieveQuery(){
        document.getElementById('advsrch').action = "search.php?query=" + document.getElementById('srch').value;
      }
      </script>

      <div class="panel panel-default">

        <form id="advsrch" action="search.php?query=" method="POST">
        <input type="hidden" value="true" name="advSearch" />
        <div class="panel-heading"> <button type="submit" name="query" onclick="retrieveQuery()" class="btn btn-primary btn-sm btn-block">Advanced Search</button> </div>
        <div class="panel-body">
          <ul class="list-group">
              <li class="list-group-item"> Star Count:
              <select class="form-control" style="width:60px;display: inline-block;" name="starCount">
                <option value=""> </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select></li>

              <li class="list-group-item">Price Between: € <input class="num-inp" name="minPrice" value="" type="number" min="0"> and
                <input class="num-inp" type="number"name="maxPrice" value="" type="number" min="0"> </li>
                <li class="list-group-item">
<label class="checkbox-inline"><input type="checkbox" value="1">Pool</label>
<label class="checkbox-inline"><input name="hasPark" type="checkbox" value="1">Park</label>
<label class="checkbox-inline"><input name="hasPets" type="checkbox" value="1">Pets</label><p></p>
<label class="checkbox-inline"><input name="hasInternet" type="checkbox" value="1">Internet</label>
<label class="checkbox-inline"><input name="hasParking" type="checkbox" value="1">Parking Lot</label>
                </li>
              <li class="list-group-item">
                      Language:
                     <select name="language" class="form-control">
                        <option value=""> </option>
                        <option value="Afrikanns">Afrikanns</option>
                        <option value="Albanian">Albanian</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Armenian">Armenian</option>
                        <option value="Basque">Basque</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Bulgarian">Bulgarian</option>
                        <option value="Catalan">Catalan</option>
                        <option value="Cambodian">Cambodian</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Croation">Croation</option>
                        <option value="Czech">Czech</option>
                        <option value="Danish">Danish</option>
                        <option value="Dutch">Dutch</option>
                        <option value="English">English</option>
                        <option value="Estonian">Estonian</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finnish">Finnish</option>
                        <option value="French">French</option>
                        <option value="Georgian">Georgian</option>
                        <option value="German">German</option>
                        <option value="Greek">Greek</option>
                        <option value="Gujarati">Gujarati</option>
                        <option value="Hebrew">Hebrew</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Hungarian">Hungarian</option>
                        <option value="Icelandic">Icelandic</option>
                        <option value="Indonesian">Indonesian</option>
                        <option value="Irish">Irish</option>
                        <option value="Italian">Italian</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Javanese">Javanese</option>
                        <option value="Korean">Korean</option>
                        <option value="Latin">Latin</option>
                        <option value="Latvian">Latvian</option>
                        <option value="Lithuanian">Lithuanian</option>
                        <option value="Macedonian">Macedonian</option>
                        <option value="Malay">Malay</option>
                        <option value="Malayalam">Malayalam</option>
                        <option value="Maltese">Maltese</option>
                        <option value="Maori">Maori</option>
                        <option value="Marathi">Marathi</option>
                        <option value="Mongolian">Mongolian</option>
                        <option value="Nepali">Nepali</option>
                        <option value="Norwegian">Norwegian</option>
                        <option value="Persian">Persian</option>
                        <option value="Polish">Polish</option>
                        <option value="Portuguese">Portuguese</option>
                        <option value="Punjabi">Punjabi</option>
                        <option value="Quechua">Quechua</option>
                        <option value="Romanian">Romanian</option>
                        <option value="Russian">Russian</option>
                        <option value="Samoan">Samoan</option>
                        <option value="Serbian">Serbian</option>
                        <option value="Slovak">Slovak</option>
                        <option value="Slovenian">Slovenian</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Swahili">Swahili</option>
                        <option value="Swedish ">Swedish </option>
                        <option value="Tamil">Tamil</option>
                        <option value="Tatar">Tatar</option>
                        <option value="Telugu">Telugu</option>
                        <option value="Thai">Thai</option>
                        <option value="Tibetan">Tibetan</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Turkish">Turkish</option>
                        <option value="Ukranian">Ukranian</option>
                        <option value="Urdu">Urdu</option>
                        <option value="Uzbek">Uzbek</option>
                        <option value="Vietnamese">Vietnamese</option>
                        <option value="Welsh">Welsh</option>
                        <option value="Xhosa">Xhosa</option>
                      </select>
              </li>
          </ul>

        </div>
        </form>
      </div>

    </div>


    <div class='col-sm-8'>
      <div class="panel panel-default">

          <div class="panel-heading"> Results for <?php if(isset($_POST['advSearch'])){
            echo "Advanced Search";} else{ echo '"'.$query.'"';} ?> </div>
          <div class="panel-body">

<?php

  $min_length = 3;

  if(strlen($query) >= $min_length || isset($_POST['advSearch'])){ // if query length > minLen


    if(mysqli_num_rows($raw_results) > 0){ // if there are results

      echo "
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
              <td id='hotel_type'>".str_repeat("<span class='glyphicon glyphicon-star'></span>",$results['Stars'])."</td>
              <td id='hotel_loc'>".$results['City'].", ".$results['Country']."</td>
              <td id='hotel_daily_pr'>€".$results['DailyPrice']."</td>
              <td id='info_button'><a href='info_page.php?hotel_id=".$results['RegistrationId']."'
              class='btn btn-default'>Info Page</a></td>

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
  </div>
</div>


</body>
</html>
