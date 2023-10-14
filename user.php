<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Dashboard</title>

  <link rel="stylesheet" href="css/table.css">

  <link rel="stylesheet" href="css/layout.css">

  <link rel="stylesheet" href="css/backend.css">
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

