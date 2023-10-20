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
    <link rel="stylesheet" href="css/style.css">

    <title>Error</title>
</head>

<body class="bg-secondary">
    <?php require "config.php";
    session_start();
    if (session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED || !isset($_SESSION['username'])) {
        echo  '<nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">IAU Store Inventory System</a>
    </nav>
    <div style=" margin-top: 11%; margin-left: 37%;" class="container">
        <h1 style="font-size: 250px;">404</h1>
        <p style=" margin-left: 0%; font-size: 25px;">Uh Oh! Page not found!<a style=" font-size: 25px;" class="btn btn-link" href="home.php">Go to Home page</a></p>
    </div>
    <footer style="margin-top: 12%;" class=" py-3  bg-dark">
        <div class="container bg-dark">
            <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
        </div>
    </footer>';
    } else {
        echo  '<nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">IAU Store Inventory System</a>
    </nav>
    <div style=" margin-top: 11%; margin-left: 37%;" class="container">
        <h1 style="font-size: 250px;">404</h1>
        <p style=" margin-left: 0%; font-size: 25px;">Uh Oh! Page not found!<a style=" font-size: 25px;" class="btn btn-link" href="landing.php">Go to Landing page</a></p>
    </div>
    <footer style="margin-top: 12%;" class=" py-3  bg-dark">
        <div class="container bg-dark">
            <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
        </div>
    </footer>';
    }

    ?>


</body>

</html>