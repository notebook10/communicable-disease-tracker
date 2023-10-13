<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="css/table.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/backend.css">
</head>
  <body>
    <div class="container">
Welcome! <a href="logout.php">Logout</a>
    <h1>Admin</h1>
        <div class="row">
            <div class="col col-md-6">
                <?php include "create_location.php" ?>
            </div>

            <div class="col col-md-6">
                <?php include "create_disease.php" ?>
            </div>

            <div class="col col-md-12">
                <?php include "modify_posts.php" ?>
            </div>
        </div>
    </div>
  </body>
</html>
