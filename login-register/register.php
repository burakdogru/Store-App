<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7187ab1959.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-dark">
    <?php
    require "../config.php";
    $email = $username = $password = $confirm_password = "";
    $email_err = $username_err = $password_err = $confirm_password_err = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inp_email = trim($_POST['email']);
        $inp_username = trim($_POST['username']);
        $inp_password = trim($_POST['password']);
        $inp_r_password = trim($_POST['r_password']);

        if (empty($inp_email)) {
            $email_err = "Please enter email.";
        } elseif (!filter_var($inp_email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email.";
        } else {
            $email = $inp_email;
        }

        if (empty($inp_username)) {
            $username_err = "Please enter username.";
        } elseif (!filter_var(
            $inp_username,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))
        )) {
            $username_err = "Please enter a valid Username.";
        } elseif (strlen($inp_username) < 4) {
            $username_err = "Username must have at least 4 characters.";
        } else {
            $username = $inp_username;
        }

        if (empty($inp_password)) {
            $password_err = "Please enter password.";
        } elseif (strlen($inp_password) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = $inp_password;
        }

        if (empty($inp_r_password)) {
            $confirm_password_err = "Please confirm password.";
        } else {
           
            $confirm_password = $inp_r_password;
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {

            if ($stmt = $con->prepare("SELECT id FROM users WHERE email = ?")) {
                $stmt->bind_param("s", $param_email);
                $param_email = $inp_email;
                if ($stmt->execute()) {
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        $email_err = "This email is already taken.";
                    } else {
                        $sql = "SELECT id FROM users WHERE username = ?";
                        if ($stmt = $con->prepare($sql)) {
                            $stmt->bind_param("s", $param_username);
                            $param_username = $inp_username;
                            if ($stmt->execute()) {
                                $stmt->store_result();
                                if ($stmt->num_rows > 0) {
                                    $username_err = "This username is already taken.";
                                }else{
                                    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
                                    if ($res = $con->query($sql)) {
                                        header("location: login.php");
                                    } else {
                                        echo "Oops! An Error Occuered. Please try again later.";
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }
    }

    ?>
    <nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="../home.php">IAU Store Inventory System</a>
    </nav>
    <div style="width: 1000px; margin-top: 6%; border-radius: 25px;" class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card bg-success">
                    <div class="card-header">
                        <h3 class="text-center text-dark">Registration</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label " for="email"><i class="fa-solid fa-envelope"></i></label>
                                <div class="col-sm-10 ">
                                    <input placeholder="example@hotmail.com" style="border-radius: 20px;" type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label " for="username"><i class="fa-solid fa-user"></i></label>
                                <div class="col-sm-10 ">
                                    <input placeholder="Enter Username" style="border-radius: 20px;" type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label " for="password"><i class="fa-solid fa-lock"></i></label>
                                <div class="col-sm-10 ">
                                    <input placeholder="Enter Password" style="border-radius: 20px;" type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label " for="r_password"><i class="fa-solid fa-lock"></i></label>
                                <div class="col-sm-10 ">
                                    <input placeholder="Re-type Password" style="border-radius: 20px;" type="password" name="r_password" id="r_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button style="border-radius: 20px;" type="submit" class="btn btn-primary btn-block btn-dark">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class=" py-3 bg-secondary">
        <div class="container bg-secondary">
            <p class="text-center bg-secondary text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>