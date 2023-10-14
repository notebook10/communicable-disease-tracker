<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Dashboard</title>

  <link rel="stylesheet" href="css/table.css">

  <link rel="stylesheet" href="css/layout.css">

  <link rel="stylesheet" href="css/backend.css">

  <!-- plugins for date and timepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</head>
  <body>
    <div class="container">
    <a class="logout btn btn-danger" href="logout.php">Logout</a>
    
      <div class="dashboard-container">
        <div class="row">
            <div class="col col-md-12">
                <?php include "create_post.php" ?>
                <hr />
                <?php include "search_post.php" ?>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
$( function() {
  $( "#datepicker, #searchdate" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  
  $( "#timepicker, #searchtime" ).timepicker();
} );
</script>

