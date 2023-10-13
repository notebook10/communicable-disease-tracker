<?php

session_start();

include_once 'config/database.php';
include_once 'app/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['email'])){
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $findUser = $user->getOne($email);
    
    // Validate the credentials (you can replace this with your own validation logic)
    if($user->id != null && password_verify($password, $user->password)){
        // Store the username in the session
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = $user->is_admin;
        $_SESSION['user_id'] = $user->id;

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
