<?php
  session_start();
  include_once 'mysqli_connect.php';

  $user_id = $_SESSION['usr_id'];
  $redirectToHotelReg = false;



  $testHasHotel = mysqli_query($connection,
    "SELECT * FROM `hotel users` WHERE users_userId='".$user_id."'");

  if (mysqli_num_rows($testHasHotel) == 0) {
    $redirectToHotelReg = true;
  }


$error = false;
$usertype = "0";
if (isset($_POST['signup'])) {
    $hotelName = mysqli_real_escape_string($connection, $_POST['hotelName']);
    $hotelInfo = mysqli_real_escape_string($connection, $_POST['hotelInfo']);
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $hasPool = $_POST['hasPool'];
    $hasPark = $_POST['hasPark'];
    $hasPest = $_POST['hasPets'];
    $hasInternet = $_POST['hasInternet'];
    $hasParking = $_POST['hasParking'];

    $languages = "";
    foreach ($_POST['languages'] as $lang)
    {
           $languages .= $lang . ",";
    }
    $languages = substr($languages,0,-1);
    $starCount = $_POST['starCount'];




}
?>

<!DOCTYPE html>
<html>
<head>
  <title>HRS - Hotel Registration"</title>
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
                    <?php } else { ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
<!--NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END NAVBAR END -->


<div class="col-md-10 col-md-offset-1 well">
  <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend>Hotel Registration</legend>
      <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">Hotel Name</label>
        <div class="col-lg-10">
          <input class="form-control" placeholder="Hotel Name" name="hotelName" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="city" class="col-lg-1 control-label">City</label>
        <div class="col-lg-3">
          <input class="form-control" name="city" placeholder="City" type="text">
        </div>
        <label for="province" class="col-lg-1 control-label">Province</label>
        <div class="col-lg-3">
          <input class="form-control" name="province" placeholder="Province" type="text">
        </div>
        <label for="country" class="col-lg-1 control-label">Country</label>
        <div class="col-lg-3">
          <input class="form-control" name="country" placeholder="Country" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="textArea" class="col-lg-2 control-label">Hotel Information</label>
        <div class="col-lg-10">
          <textarea class="form-control" name="hotelInfo" rows="3" id="textArea"></textarea>
          <span class="help-block">Give information about your Hotel here.</span>
        </div>
      </div>
      <div class="form-group">
        <label for="details" class="col-lg-1 control-label">Details</label>
        <div id="details" class="col-lg-5 checkbox">

            <label><input name="hasPool" type="checkbox"> Has a Pool</label>
            <label><input name="hasPark" type="checkbox"> Has a Park</label>
            <label><input name="hasPets" type="checkbox"> Allows Pets</label>
            <p></p>
            <label><input name="hasInternet" type="checkbox"> Has Internet</label>
            <label><input name="hasParking" type="checkbox"> Has a Parking Lot</label>
        </div>
        <div class="col-lg-2">
          <label for="starCount" class="col-lg-4 control-label">Stars</label>
            <select class="form-control" id="starCount" name="starCount">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
      </div>
      <div class="form-group">
      <div class="col-lg-4 col-md-offset-1">
      <label for="select" class="col-lg-4 control-label">Languages</label>
      <select multiple="" name="languages[]" class="form-control">
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
      <span class="help-block">Hold 'Ctrl' button to pick multiple languages.</span>
      </div>

      <label for="images" class="col-lg-2 control-label">Hotel Images</label>
      <div id="images" class="col-lg-6 well">
      <div class="form-group">
      <div>
        <label for="select" class="col-lg-2 control-label">Image 1</label>
          <label class="col-lg-3 btn btn-default btn-file">
            Browse <input type="file"name="image1" style="display: none;">
          </label>
      </div>
      <div>
        <label for="select" class="col-lg-2 control-label">Image 2</label>
          <label class="col-lg-3 btn btn-default btn-file">
            Browse <input type="file" name="image2" style="display: none;">
          </label>
      </div>
      </div>
      <span class="help-block">Upload images for your hotel.</span>
      </div>

      </div>


      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Cancel</button>
          <button type="submit" name="register" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>




</body>