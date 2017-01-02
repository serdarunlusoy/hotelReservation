<?php
session_start();

if (isset($_SESSION['usr_id']) != "") {
    header("Location: index.php");
}

include_once 'mysqli_connect.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $usertype = mysqli_real_escape_string($con, $_POST['usertype']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email . "' and password = '" . md5($password) . "' and usertype = '" . $usertype . "'");

    if ($row = mysqli_fetch_array($result)) {
        if ($row['usertype'] == '1') {
            $_SESSION['usr_id'] = $row['userId'];
            $_SESSION['usr_email'] = $row['email'];
            //$_SESSION['usr_name'] = $row['name'];
            header("Location: index.php");
        } else if ( $row['usertype'] == '2' ){
            $_SESSION['usr_id'] = $row['userId'];
            $_SESSION['usr_email'] = $row['email'];
            header("Location: admin_page.php");
        } else {
            $_SESSION['usr_id'] = $row['userId'];
            $_SESSION['usr_email'] = $row['email'];
            header("Location: hotel_admin_page.php");
        }
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Login</title>
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
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                    <fieldset>
                        <legend>Login</legend>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="name">User Type</label>
                            <div class="radio">
                                <label><input type="radio" name="usertype" value="1">User</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="usertype" value="2">Admin</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="usertype" value="3">Hotel Admin</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="login" value="Login" class="btn btn-primary" />
                        </div>
                    </fieldset>
                </form>
                <span class="text-danger"><?php
                    if (isset($errormsg)) {
                        echo $errormsg;
                    }
                    ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">	
                New User? <a href="register.php">Sign Up Here</a>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
