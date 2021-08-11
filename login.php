<?php require_once("../config.php"); ?>


<?php

//Login function
if (isset($_POST['login'])) {

    $username = escape_string($_POST['username']);
    $password = escape_string($_POST['password']);

    $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
    confirm($query);

    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Incorrect username or password!');</script>";
    } else {
        $_SESSION['username'] = $username;
        redirect('index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    
    <title>Travel - Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
</head>

<body id="page-top">
    <section id="about">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-4">
                    <form method="POST" class="form-signin">
                        <h3 class="mb-3 font-weight-normal text-center">Welcome to Travel website</h3>
                        <h1 class="mb-3 font-weight-normal text-center">Sign in</h1>
                        <label class="sr-only">username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username" required="" autofocus="">
                        <label class="sr-only">Password</label>
                        <input name="password" type="password" class="form-control mt-4" placeholder="Password" required="">
                        <div class="text-center m-4">
                            <a class="btn text-muted" href="sign-up.php">Dont have account yet? Signup here!</a>
                        </div>
                        <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>