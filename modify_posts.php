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
      <?php if(isset($error)): ?>
        <h5><?php echo $error; ?></h5>
        <?php endif; ?>
        <div class="card style-1">
            <div class="card-header card__header">
                <h4>Tracker List</h4>
            </div>

            <div class="card-body card__content">
                <table class="pure-table">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Disease</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Time</th>
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
                                        echo "<a class='btn btn-primary' href='edit_post.php?id={$id}'>Edit</a>";
                                        echo "<form action='delete_post.php' method='POST'>";
                                        echo "<input type='hidden' name='post_id' value='{$id}'>";
                                        echo "<button class='btn btn-danger' type='submit'>Delete</button>";
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
        </div>
      
    </div>

<!-- <?php
include_once "app/Views/partials/layout_footer.php";
?>	 -->
