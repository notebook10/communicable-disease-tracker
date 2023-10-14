<?php

session_start();

include_once "config/database.php";

$database = new Database();
$db = $database->getConnection();
?>

<?php
if(! isset($_SESSION['email'])) {
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Form</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/layout.css">
</head>
  <body>
    <div class="container">

        <div class="signup-form">
            <div class="login">
                <h1>COMMUNICABLE DISEASE TRACKER</h1>
                <form method="POST" action="login.php">
                    <p><b class="pl-5" for="email">Email Address</b><input type="text" name="email" id="email" value="" placeholder="Enter Email address"></p>
                    <p><b class="pl-5" for="password">Password</b><input type="password" name="password" value="" placeholder="Enter Password"></p>
                    <p class="submit"><input type="submit" name="commit" value="Login"></p>
                </form>
                <a href="create_user.php">Create User</a>
            </div>
        </div>
    </div>
  </body>
</html>
<?php
} else {
    ?>

<?php if ($_SESSION['is_admin'] == 1) { ?>
    <!-- ADMIN -->
    <?php include "admin.php"; ?>
<?php } else { ?>
    <!-- USER -->
    <?php include "user.php"; ?>
<?php }
    } ?>
