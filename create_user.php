<?php

session_start();

include_once 'config/database.php';
include_once 'app/User.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$page_title = "Create User";
// include_once "app/Views/partials/layout_header.php";

// echo "<div class='mb-3'>";
// echo "<a href='/' class='btn btn-primary pull-right'>Home</a>";
// echo "</div>";

// POST
if($_POST) {
    date_default_timezone_set('Asia/Manila');
    $user->username = $_POST["username"];
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];
    $user->is_admin = isset($_POST["is_admin"]) ? $_POST["is_admin"] : 0;
    $user->created_at = date('Y-m-d H:i:s', time());

    // create
    if($user->create()) {
        echo "<div class='alert alert-success'>User was created.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to create user.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign up</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/layout.css">
</head>
  <body>
	<div class="container">
		<div class="signup-form">
			<div class="login">
			<h1>Sign up</h1>
			<?php if(isset($error)): ?>
				<h5><?php echo $error; ?></h5>
			<?php endif; ?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<p for="username"><b class="pl-5">Username</b>
					<input type='text' name='username' class='form-control' minlength=4 required/>
				</p>
			
				<p for="email" ><b class="pl-5">Email</b>
				<input type='email' name='email' class='form-control' minlength=4 required/>
				</p>
			
				<p for="password" ><b class="pl-5">Password</b>
				<input type='password' name='password' class='form-control' minlength=4 required/>
				</p>
				
				<?php if (isset($_SESSION['is_admin'])) {
				    if ($_SESSION['is_admin'] == '1') {
				        ?>
					<label><input type="checkbox" name="is_admin" 
						value="1">is Admin?</label> 
				<?php }
				    } ?>
			
				<p class="submit">
					<input type="submit" class="btn btn-primary" value="Create">
				</p>
				
				<a href="index.php">Back to Login</a>
			</form>
		</div>
	</div>
  </body>
</html>

<!-- <?php
include_once "app/Views/partials/layout_footer.php";
?>	 -->