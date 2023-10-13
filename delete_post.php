<?php

session_start();

include_once 'config/database.php';
include_once 'app/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if($_POST && isset($_POST["post_id"]) ){
    $post->id = $_POST["post_id"];
    
    // create
    if($post->delete()){
        header('Location: /');
    }
    else{
        echo "<div class='alert alert-danger'>Unable to delete post.</div>";
    }
}