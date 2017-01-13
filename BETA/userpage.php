<?php
session_start();
include_once 'mysqli_connect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: login.php");
}
 



   
$user_id = $_SESSION['usr_id'];

$reservation_data = mysqli_query($connection, "SELECT * FROM reservations
      WHERE (`users_userId` = '" . $user_id  . "')") or die(mysql_error());



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
                <form role="form" action='deletereservation.php' method="get" name="reservationId">
                    <fieldset>
                        <legend>Reservation List</legend>

                        <div class="form-group">
                          <?php 

 if(mysqli_num_rows($reservation_data) > 0){ // if there are results

      echo "
      <table class='table table-hover' style='max-width: none'>
        <thead>
          <tr>
            
            <th>People Amount</th>
            <th>Room Amount</th>
            <th>Total Price </th>
            <th>Start Date </th>
            <th>End Date </th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";

      while($results = mysqli_fetch_array($reservation_data)){
        $reservationId=$results['reservationId'];

        echo "            <tr>
              
              <td>".$results['People']."</td>
              <td>".$results['RoomAmount']."</td>
              <td>€".$results['Price']."</td>
              <td>".$results['StartDate']."</td>
              <td>".$results['EndDate']."</td>
              <td><input type='hidden' name='reservationId' value=".$results['reservationId']."></td>
              <td ><input type='submit' name='reservationId' value='Cancel Reservation' class='btn btn-default'></td>

            </tr>";
      }
      echo "          </tbody>
      
        </table>
    </div>";

    }
    else{ // if there is no matching rows do following
      echo "No results";
    }

                          ?>
                            
                        </div>
                    </fieldset>
                    </form>
                    </div>
                    </div>
                    </div>


            </div>
        </div>
        
        
</body>
</html>
