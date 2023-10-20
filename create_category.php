<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

</head>

<body class="bg-secondary">
  <?php
  require_once "config.php";
  session_start();
  if(session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED || !isset($_SESSION['username'])){
    header("location: error.php");
    exit();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $con->real_escape_string($_POST['name']);
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    if (mysqli_query($con, $sql)) {
      header("location: landing.php");
      mysqli_close($link);
      exit();
    } else {
      echo '<div class="alert alert-danger mt-3" role="alert">Item could not be added to the database!</div>';
    }
  }
  ?>
  <nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="landing.php">IAU Store Inventory System</a>
  </nav>
  <div class="container mt-5">

    <div class="container mt-5 " style="width: 1000px; margin-left: -100px;">
      <h1 class="text-white">Create New Category</h1>
      <form method="post">
        <div class="form-group">
          <label class="text-white" for="name">Category Name</label>
          <input placeholder="Enter Category Name" type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="landing.php" class="btn btn-dark ml-2">Cancel</a>
      </form>
    </div>
  </div>
  <footer style="margin-top: 30.8%;" class=" py-3 bg-dark">
    <div class="container bg-dark">
      <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
    </div>
  </footer>
</body>

</html>