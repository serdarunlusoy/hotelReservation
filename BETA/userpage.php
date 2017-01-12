<?php
session_start();
include_once 'mysqli_connect.php';
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

    <div class="container">
        <div class="jumbotron" style="position: middle">
              <div class="row">
              <h2>Welcome to your Profile <?php echo $_SESSION['usr_email']; ?></p></h2>
              <div class="col-sm-4"><button>List my reservations</button> </div>
              <div class="col-sm-8">Reservations List</div>
              <font size="48">
 
              </font>
              
              </div>
            
            <hr>

    </div>
</body>
</html>
