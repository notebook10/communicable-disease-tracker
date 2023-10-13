<?php

include_once 'config/database.php';
include_once 'app/Disease.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$disease = new Disease($db);

$page_title = "Create Disease";

// POST
if($_POST && isset($_POST["disease"])) {
    date_default_timezone_set('Asia/Manila');
    $disease->disease = $_POST["disease"];
    $disease->created_at = date('Y-m-d H:i:s', time());

    // create
    if($disease->create()) {
        echo "<div class='alert alert-success'>Disease was created.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to create disease.</div>";
    }
}
?>

	<div class="card style-1">
			<div class="card-header card__header">
				<h4>Create Disease</h4>
			</div>

			<div class="card-body card__content">
			<?php if(isset($error)): ?>
				<h5><?php echo $error; ?></h5>
			<?php endif; ?>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<div class="form-group">
						<label for="disease">Disease</label>
						<input type='text' name='disease' class='form-control' minlength=4 required/>
					</div>
					
					<div class="form-group form-group--sm">
						<div>
							<button type="submit" class="btn btn-primary mt-3">Add Disease</button>
						</div>
					</div>
				</form>
			</div>
		</div>

<!-- <?php
include_once "app/Views/partials/layout_footer.php";
?>	 -->