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
    <?php include "layout/header.php" ?>
    <div class="container">
      <div class="dashboard-container">
        <div class="row">
          <div class="col col-md-12">
              <?php include "modify_posts.php" ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
