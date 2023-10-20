<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7187ab1959.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">

    <title>View Item</title>
</head>

<body class="bg-secondary">
<?php
  session_start();
  if(session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED || !isset($_SESSION['username'])){
    header("location: ../error.php");
    exit();
  }
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require "../config.php";

    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM inventory WHERE id = $id";

    if ($res = mysqli_query($con, $sql)) {

            if (mysqli_num_rows($res) == 1) {

                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                $item_name = $row["item_name"];
                $category_name = $row["category_name"];
                $amount = $row["amount"];
                $price = $row["price"];
                $isNew = $row["isNew"];

            } else {
                header("location: ../error.php");
                exit();
            }

    }   else {
        echo "Oops! An Error Occuered. Please try again later.";
    }
    mysqli_close($con);
} else {
    header("location: ../error.php");
    exit();
}
?>
  <nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../landing.php">IAU Store Inventory System</a>
  </nav>
  <div style="width:1000px;" class="container mt-5">
    <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="">View Item</h1>
                    <div class="form-group mt-5">
                        <h5 style=" text-decoration: underline;" >Item Name</h5>
                        <p class="" ><b><?php echo $item_name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5 style=" text-decoration: underline;" >Category Name</h5>
                        <p class="" ><b><?php echo $category_name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5 style=" text-decoration: underline;">Price</h5>
                        <p><b><?php echo $price; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5 style=" text-decoration: underline;">Amount</h5>
                        <p><b><?php echo $amount; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5 style=" text-decoration: underline;">Is this product new ?</h5>
                        <p><b><?php if($isNew){
                            echo "Yes";
                        }else
                        {
                            echo "No";
                        }
                        ; ?></b></p>
                    </div>
                    <p><a href="../landing.php" class="btn btn-info">Back</a></p>
                </div>
            </div>
        </div>
    </div>
    <footer style="margin-top: 13%;" class=" py-3  bg-dark">
      <div class="container bg-dark">
        <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
      </div>
    </footer>

</body>

</html>