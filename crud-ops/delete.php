<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7187ab1959.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">

    <title>Delete Item</title>

</head>

<body class="bg-secondary">
    <?php
    require "../config.php";
    session_start();
    if(session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED || !isset($_SESSION['username'])){
      header("location: ../error.php");
      exit();
    }
    if (isset($_POST["id"]) && !empty($_POST["id"])) {


        $id = trim($_POST["id"]);
        $sql = "DELETE FROM inventory WHERE id = $id";

        if ($con->query($sql)) {
            header("location: ../landing.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_close($con);
    } else {
        if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            $id = trim($_GET["id"]);

            $query = "SELECT item_name FROM inventory WHERE id = $id";
            if ($res = $con->query($query)) {
                if (mysqli_num_rows($res) == 1) {
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    $item_name = $row["item_name"];
                } else {
                    header("location: ../error.php");
                    exit();
                }
            } else {
                echo "Oops! An Error Occuered. Please try again later.";
            }
        } else {
            if (empty(trim($_GET["id"]))) {
                header("location: ../error.php");
                exit();
            }
        }
    }
    ?>
    <nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../landing.php">IAU Store Inventory System</a>
    </nav>
    <div style=" margin-top: 5%;" class="  mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="mt-5 mb-3">Delete Item</h2>
                    <form method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete "<strong><?php echo $item_name;?></strong>"  item ?</p>
                            <p>
                                <input type="submit" value="Delete" class="btn btn-danger">
                                <a href="../landing.php" class="btn btn-dark">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer style="margin-top: 27.7%;" class=" py-3  bg-dark">
        <div class="container bg-dark">
            <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
        </div>
    </footer>
</body>

</html>