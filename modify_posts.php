<?php

include_once 'config/database.php';
include_once 'app/Post.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$posts = $post->getPosts();
$postNum = $posts->rowCount();

$page_title = "Modify User Posts";

// POST
// if($_POST && isset($_POST["disease"])){
//     date_default_timezone_set('Asia/Manila');
// 	$disease->disease = $_POST["disease"];
// 	$disease->created_at = date('Y-m-d H:i:s', time());

// 	// create
// 	if($disease->create()){
// 		echo "<div class='alert alert-success'>Disease was created.</div>";
// 	}else{
// 		echo "<div class='alert alert-danger'>Unable to create disease.</div>";
// 	}
// }
?>


    <div class="post">
      <h1>User Post</h1>
 
      <!-- Here pure-table class is used -->
      <?php if(isset($error)): ?>
        <h5><?php echo $error; ?></h5>
        <?php endif; ?>
        <table class="pure-table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Disease</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        if($postNum > 0) {
                            while($row = $posts->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo "<tr>";
                                echo "<td>{$location}</td>";
                                echo "<td>{$disease}</td>";
                                echo "<td>{$username}</td>";
                                echo "<td>{$date}</td>";
                                echo "<td>{$time}</td>";
                                echo "<td>";
                                echo "<a href='edit_post.php?id={$id}'>Edit</a>";
                                echo "<form action='delete_post.php' method='POST'>";
                                echo "<input type='hidden' name='post_id' value='{$id}'>";
                                echo "<button type='submit'>Delete</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
?>
                </tr>
            </tbody>
        </table>
      
    </div>

<!-- <?php
include_once "app/Views/partials/layout_footer.php";
?>	 -->
