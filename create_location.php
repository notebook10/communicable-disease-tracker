<?php

include_once 'config/database.php';
include_once 'app/Location.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$location = new Location($db);
$locations = $location->getLocations();
$locationNum = $locations->rowCount();

$page_title = "Create Location";

// POST
if($_POST && isset($_POST["location"])) {
    date_default_timezone_set('Asia/Manila');
    $location->location = $_POST["location"];
    $location->created_at = date('Y-m-d H:i:s', time());

    // create
    if($location->create()) {
        echo "<div class='alert alert-success'>Location was created.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to create location.</div>";
    }
}
?>

<div class="card style-1">
	<div class="card-header card__header">
		<h4>Create Location</h4>
	</div>

	<div class="card-body card__content">
	<?php if(isset($error)): ?>
		<h5><?php echo $error; ?></h5>
	<?php endif; ?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<div class="form-group">
				<label for="location">Location</label>
				<input type='text' name='location' class='form-control' minlength=4 required/>
			</div>
			
			<div class="form-group form-group--sm">
				<div>
					<button type="submit" class="btn btn-primary mt-3">Add Location</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="card style-1">
	<div class="card-header card__header">
		<h4>Locations</h4>
	</div>
	<div class="card-body card__content">
		<table>
			<thead>
				<tr>
					<th>Location</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				<?php
					 if($locationNum > 0) {
						while($row = $locations->fetch(PDO::FETCH_ASSOC)) {
							extract($row);
							echo "<tr>";
							echo "<td>{$location}</td>";
							echo "<td>". date("Y-m-d h:i:s A", strtotime($created_at)) ."</td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>