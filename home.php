<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  
  <title>Store Inventory Home</title>
</head>

<body class="bg-dark">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-white" href="">IAU Store Inventory System</a>
    <p style="margin-left: auto; margin-top: 20px; color: white;"><a class="btn btn-link " href="login-register/login.php">Log In</a></p>

    </div>
  </nav>

  <div class="jumbotron jumbotron-fluid bg-secondary">
    <div class="container">
      <h1 class="display-4 text-white">Welcome to our store!</h1>
      <p class="lead text-white">Here you can view store. You have to login for managing inventory</p>
    </div>
  </div>
  <div class="container mt-5 ng-">
    <div class="row">
      <?php
      require_once "config.php";
      session_start();
      session_destroy();


      $query = "SELECT * FROM inventory";

      if ($res = mysqli_query($con, $query)) {
        if (mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_array($res)) {
            if ($row['isNew'] == 1) {
              echo ' <div style = "width: 320px;" class=" mb-4 bg-dark">
                <div style ="border-style: solid; border-color: white; width: 300px;"   class="card bg-dark text-white ">
                  <div  class="card-body">

                    <div class="ribbon">New!</div>

                    <h5 class="card-title">' . $row['item_name'] . '</h5>
                    <p class="card-text">Category: ' . $row['category_name'] . '</p>
                    <p class="card-text">Price: ' . "$" . $row['price'] . '</p>
                    <p class="card-text">Amount: ' . " x" . $row['amount'] . '</p>
 
                  </div>
                </div>
              </div>';
            } else {
              echo ' <div style = "width: 320px;" class=" mb-4 bg-dark">
                <div style ="border-style: solid; border-color: white; width: 300px;"   class="card bg-dark text-white ">
                  <div  class="card-body">
                    <h5 class="card-title">' . $row['item_name'] . '</h5>
                    <p class="card-text">Category: ' . $row['category_name'] . '</p>
                    <p class="card-text">Price: ' . "$" . $row['price'] . '</p>
                    <p class="card-text">Amount: ' . " x" . $row['amount'] . '</p>

                  </div>
                </div>
              </div>';
            }
          }
          mysqli_free_result($res);
        } else {
          echo '<div class="alert alert-danger ml-3"><em>Nothing Found .</i></div>';
        }
      } else {
        echo "Something went wrong.";
      }
      mysqli_close($con);
      ?>
    </div>
  </div>
  <footer class=" py-3  bg-dark">
    <div class="container bg-dark">
      <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>