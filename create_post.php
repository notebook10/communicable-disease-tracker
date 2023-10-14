<?php

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

$locations = $location->getLocations();
$locationNum = $locations->rowCount();

$diseases = $disease->getDiseases();
$diseaseNum = $diseases->rowCount();

$page_title = "Create Post";

// POST
if($_POST && isset($_POST["location_id"]) && $_POST['operation'] === 'create') {
    date_default_timezone_set('Asia/Manila');
    $post->location_id = $_POST["location_id"];
    $post->disease_id = $_POST["disease_id"];
    $post->date = $_POST["date"];
    $post->time = $_POST["time"];
    $post->created_at = date('Y-m-d H:i:s', time());
        
    // create
    if($post->create()) {
        echo "<div class='alert alert-success'>Post was created.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to create post.</div>";
    }
}
?>

	<div class="card style-1">
			<div class="card-header card__header">
				<h4>Create Post</h4>
			</div>

			<div class="card-body card__content">
			<?php if(isset($error)): ?>
				<h5><?php echo $error; ?></h5>
			<?php endif; ?>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<input type='hidden' name='operation' value="create" />
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
                                                echo "<option value={$id}>{$location}</option>";
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
                echo "<option value={$id}>{$disease}</option>";
            }
        }
?>
								</select>
							</div>

							<div class="form-group">
								<label for="date">Date</label>
								<input type='text' name='date' class='form-control' minlength=4 required/>
							</div>

							<div class="form-group">
								<label for="time">Time</label>
								<input type='text' name='time' class='form-control' minlength=4 required/>
							</div>
							
							<div class="form-group form-group--sm">
								<div>
									<button type="submit" class="btn btn-primary mt-3">Add Tracker</button>
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