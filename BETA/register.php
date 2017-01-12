<?php
session_start();

if (isset($_SESSION['usr_id'])) {
    header("Location: index.php");
}
include_once 'mysqli_connect.php';

$error = false;
$usertype = "0";
if (isset($_POST['signup'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    if (isset($_POST['usertype'])) {
      $usertype = mysqli_real_escape_string($connection, $_POST['usertype']);
    } else {$error = true;
    $usertype_error = "Please pick a User Type";}


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    $testEmailResult = mysqli_query($connection, "SELECT EXISTS(SELECT * FROM users WHERE email='".$email."')");
    if($testEmailResult == true){
        $error = true;
        $email_error = "Email already exists!";
    }
    if (strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if ($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }

    if (!$error) {
        if (mysqli_query($connection, "INSERT INTO users(email,password,usertype)
            VALUES('" . $email . "', '" . md5($password) . "', '".$usertype."')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
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
            <div class="col-md-6 col-md-offset-3 well">
              <div class="col-md-7" style="border-right: 1px solid #AAA;">
                  <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                      <fieldset>
                          <legend>Sign Up</legend>

                          <div class="form-group">
                              <label for="name">Email</label>
                              <input type="text" name="email" placeholder="Email" required value="<?php if ($error) echo $email; ?>" class="form-control" />
                              <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                          </div>

                          <div class="form-group">
                              <label for="name">Password</label>
                              <input type="password" name="password" placeholder="Password" required class="form-control" />
                              <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                          </div>

                          <div class="form-group">
                              <label for="name">Confirm Password</label>
                              <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                              <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                          </div>

                          <div class="form-group">
                              <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                          </div>
                      </fieldset>

                  <span class="text-success"><?php
                      if (isset($successmsg)) {
                          echo $successmsg;
                      }
                      ?></span>
                  <span class="text-danger"><?php
                      if (isset($errormsg)) {
                          echo $errormsg;
                      }
                      ?></span>
              </div>
              <div class="col-md-5">
                <legend>User Type</legend>

                <div class="radio">
                    <label><input name="usertype" type="radio" value="1">User</label>
                    <p><em>For visitors who wish to just reserve a vacation.</em></p><p></p>
                </div>
                <div class="radio">
                    <label><input name="usertype" type="radio" value="3">Hotel User</label>
                    <p><em>For hotel owners and employees who wish to be represented on our system.</em></p><p></p>
                </div>

                <div style="color:red;">
                <div class="radio">
                    <label><input name="usertype" type="radio" value="2">!!!Admin!!!</label>
                </div>
                <div class="radio">
                    <label><input name="usertype" type="radio" value="4">!!!Registrant!!!</label>
                </div>
                <span class="text-danger"><?php if (isset($usertype_error)) echo $usertype_error; ?></span>
                </div>



              </div>
            </div>
          </form>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
                Already Registered? <a href="login.php">Login Here</a>
            </div>
        </div>
    </div>


</body>
</html>



