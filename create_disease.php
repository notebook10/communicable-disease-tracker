<?php

include_once 'config/database.php';
include_once 'app/Disease.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$disease = new Disease($db);
$diseases = $disease->getDiseases();
$diseaseNum = $diseases->rowCount();

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

<div class="card style-1">
	<div class="card-header card__header">
		<h4>Diseases</h4>
	</div>
	<div class="card-body card__content">
	<table class="pure-table w-100">
			<thead>
				<tr>
					<th>Disease Name</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				<?php
                     if($diseaseNum > 0) {
                         while($row = $diseases->fetch(PDO::FETCH_ASSOC)) {
                             extract($row);
                             echo "<tr>";
                             echo "<td>{$disease}</td>";
                             echo "<td>". date("Y-m-d h:i:s A", strtotime($created_at)) ."</td>";
                             echo "</tr>";
                         }
                     }
?>
			</tbody>
		</table>
	</div>
</div>
