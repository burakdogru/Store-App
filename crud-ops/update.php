<!doctype html>
<html lang="en">

<head>
    <title>Update Item</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-secondary">
    <?php
    session_start();
    if (session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED || !isset($_SESSION['username'])) {
        header("location: ../error.php");
        exit();
    }
    require "../config.php";
    $item_name = $amount = $price = "";
    $item_err = $amount_err = $price_err  = "";
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = $_POST["id"];
        $inp_item_name = trim($_POST['item_name']);
        $category_name = trim($_POST['category_name']);
        $inp_amount =  trim($_POST['amount']);
        $inp_price =  trim($_POST['price']);
        $isNew = trim($_POST['isNew']);

        if (empty($inp_item_name)) {
            $item_err = "Please enter a name.";
        } elseif (!filter_var(
            $inp_item_name,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => "/^[a-zA-Z\sğüşöçĞÜŞÖÇ]+$/"))
        )) {
            $item_err = "Please enter a valid name.";
        } else {
            $item_name = $inp_item_name;
        }

        if (empty($inp_amount)) {
            $amount_err = "Please enter the amount.";
        } elseif (!ctype_digit($inp_amount)) {
            $amount_err = "Please enter a positive integer value.";
        } else {
            $amount = $inp_amount;
        }

        if (empty($inp_price)) {
            $price_err = "Please enter the Price.";
        } elseif ($inp_price <= 0) {
            $price_err = "Please enter a positive integer value.";
        } else {
            $price = $inp_price;
        }
        if (empty($item_err) && empty($amount_err) && empty($price_err)) {

            $sql = "UPDATE inventory SET item_name=?, category_name=?, amount=?, price=?, isNew=? WHERE id=?";

            if ($stmt = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssidii",
                    $param_item_name,
                    $param_category_name,
                    $param_amount,
                    $param_price,
                    $param_isNew,
                    $param_id
                );

                $param_item_name = $item_name;
                $param_category_name = $category_name;
                $param_amount = $amount;
                $param_price = $price;
                $param_isNew = $isNew;
                $param_id = $id;
                if (mysqli_stmt_execute($stmt)) {
                    header("location: ../landing.php");
                    exit();
                } else {
                    echo "Oops! An Error Occuered. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            $id = trim($_GET["id"]);

            $query = "SELECT * FROM inventory WHERE id = $id";
            if ($res = mysqli_query($con, $query)) {
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
            } else {
                echo "Oops! An Error Occuered. Please try again later.";
            }
        } else {
            header("location: ../error.php");
            exit();
        }
    }

    ?>
    <nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../landing.php">IAU Store Inventory System</a>
    </nav>
    <div style="width:1000px;" class="container mt-5">
        <div class="container mt-5">
            <h1 class="text-white">Update Item</h1>
            <h4 class="text-white">Please Edit the input values  to update the item .</h4>

            <form method="post">
                <div class="form-group">
                    <label class="text-white" for="item_name">Item Name</label>
                    <input placeholder="Enter Item Name" type="text" class="form-control <?php echo (!empty($item_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_name; ?>" id="item_name" name="item_name">
                    <span class="invalid-feedback"><?php echo $item_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="text-white" for="category_name">Category Name</label>
                    <?php
                    $sql = "SELECT name FROM category ORDER BY name ASC;";
                    $res = mysqli_query($con, $sql);

                    echo '<select class="form-control" id="category" name="category_name" >';
                    foreach ($res as $r) {
                        if ($r["name"] == $category_name)
                            echo '<option selected value="' . $r["name"] . '" >' . $r["name"] . '</option>';
                        else
                            echo '<option  value="' . $r["name"] . '" >' . $r["name"] . '</option>';
                    }
                    echo "</select>";
                    mysqli_close($con);
                    ?>
                </div>
                <div class="form-group">
                    <label class="text-white" for="price">Price</label>
                    <input placeholder="Enter Price" type="number" min="0" step="0.01" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>" id="price" name="price">
                    <span class="invalid-feedback"><?php echo $price_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="text-white" for="amount">Amount</label>
                    <input placeholder="Enter Amount" type="number" step="1" class="form-control <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $amount; ?>" id="amount" name="amount">
                    <span class="invalid-feedback"><?php echo $amount_err; ?></span>
                </div>
                <div class="form-group">
                    <label class="text-white" for="isNew">Is this product new ?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isNew" id="productNew" value="1" <?php if ($isNew) echo 'checked'; ?>>
                        <label class="text-white" class="form-check-label" for="productNew">New</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isNew" id="productNotNew" value="0" <?php if (!$isNew) echo 'checked'; ?>>
                        <label class="text-white" class="form-check-label" for="productNotNew">Not New</label>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="../landing.php" class="btn btn-dark ml-2">Cancel</a>

            </form>

        </div>
    </div>
    <footer style="margin-top: 7.2%;" class=" py-3 bg-dark">
        <div class="container bg-dark">
            <p class="text-center bg-dark text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>