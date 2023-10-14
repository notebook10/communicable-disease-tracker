<?php

session_start();

include_once 'config/database.php';
include_once 'app/Post.php';
include_once 'app/Location.php';
include_once 'app/Disease.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$location = new Location($db);
$disease = new Disease($db);

$postId = isset($_GET['id']) ? $_GET['id'] : '';
$post->getOne($postId);

$locations = $location->getLocations();
$locationNum = $locations->rowCount();

$diseases = $disease->getDiseases();
$diseaseNum = $diseases->rowCount();

$page_title = "Edit Post";

?>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="css/table.css">

  <link rel="stylesheet" href="css/backend.css">
  <link rel="stylesheet" href="css/layout.css">
  <!-- plugins for date and time picker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>
  <body>
    <?php include "layout/header.php" ?>
    <div class="container">
        <div class="dashboard-container">
        <div class="row">
            <div class="col col-md-12">
				<div class="card style-1">
					<div class="card-header card__header">
						<h4>Edit Post</h4>
					</div>

					<div class="card-body card__content">
                    <?php
                        // POST
                        if($_POST && isset($_POST["location_id"]) && $_POST['operation'] === 'update') {
                            date_default_timezone_set('Asia/Manila');
                            $post->id = $_POST['id'];
                            $post->location_id = $_POST["location_id"];
                            $post->disease_id = $_POST["disease_id"];
                            $post->date = $_POST["date"];
                            $post->time = $_POST["time"];
                                
                            // create
                            if($post->update()) {
                                echo "<div class='alert alert-success'>Post was successfully updated.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Unable to update post.</div>";
                            }
                        }
?>
					<?php if(isset($error)): ?>
						<h5><?php echo $error; ?></h5>
					<?php endif; ?>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
							<input type='hidden' name='operation' value="update" />
							<input type='hidden' name='id' value="<?= $postId ?>" />
							<div class="row">
								<div class="col-md-6 m-auto">
									<div class="form-group">
										<label for="location_id">Location</label>
										<select name="location_id" class='form-control'>
											<option selected disabled>-- SELECT LOCATION --</option>
											<?php
                            if($locationNum > 0) {
                                while($row = $locations->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);
                                    if ($id == $post->location_id) {
                                        echo "<option value={$id} selected>{$location}</option>";
                                    } else {
                                        echo "<option value={$id}>{$location}</option>";
                                    }
                                }
                            }
?>
										</select>
									</div>

									<div class="form-group">
										<label for="disease_id">Disease</label>
										<select name="disease_id" class='form-control'>
											<option selected disabled>-- SELECT DISEASE --</option>
											<?php
        if($diseaseNum > 0) {
            while($row = $diseases->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                if ($id == $post->disease_id) {
                    echo "<option value={$id} selected>{$disease}</option>";
                } else {
                    echo "<option value={$id} >{$disease}</option>";
                }
            }
        }
?>
										</select>
									</div>

									<div class="form-group">
										<label for="date">Date</label>
										<input type='text' name='date' id="datepicker" class='form-control' value="<?= $post->date ?>" minlength=4 required/>
									</div>

									<div class="form-group">
										<label for="time">Time</label>
										<input type='text' name='time' id="timepicker" class='form-control' value="<?= $post->time ?>" minlength=4 required/>
									</div>
									
									<div class="form-group form-group--sm">
										<div>
											<button type="submit" class="btn btn-primary">Update Post</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
		<!-- <?php
        include_once "app/Views/partials/layout_footer.php";
?>	 -->
                </div>
            </div>
        </div>
    </div>
  </body>
</html>

<script>
$( function() {
  $( "#datepicker" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  
  $( "#timepicker" ).timepicker();
} );
</script>

	