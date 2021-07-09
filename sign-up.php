<?php require_once("../config.php"); ?>


<?php

//Signup function.
if (isset($_POST['sign-up'])) {

    $first_name    =   escape_string($_POST['first_name']);
    $last_name     =   escape_string($_POST['last_name']);
    $username      =   escape_string($_POST['username']);
    $password      =   escape_string($_POST['password']);
    $phone         =   escape_string($_POST['phone']);
    $email         =   escape_string($_POST['email']);
    $country_id    =   escape_string($_POST['country_id']);
    $city_id       =   0;
    $category      =   escape_string($_POST['category']);


    $query = query("INSERT INTO users(first_name,last_name,username,password,phone,email,country_id,city_id,category) VALUES('{$first_name}','{$last_name}','{$username}','{$password}','{$phone}','{$email}','{$country_id}','{$city_id}','{$category}')");
    confirm($query);

    redirect("login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Travel - Signup</title>
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
                        <h1 class="mb-3 font-weight-normal text-center">Signup</h1>
                        <label class="sr-only">First name</label>
                        <input name="first_name" type="text" class="form-control mt-4" placeholder="First name" required="" autofocus="">
                        <label class="sr-only">Last name</label>
                        <input name="last_name" type="text" class="form-control mt-4" placeholder="Last name" required="">
                        <label class="sr-only">Username</label>
                        <input name="username" type="text" class="form-control mt-4" placeholder="Username" required="">
                        <label class="sr-only">Password</label>
                        <input name="password" type="password" class="form-control mt-4" placeholder="Password" required="">
                        <label class="sr-only">Phone</label>
                        <input name="phone" type="text" class="form-control mt-4" placeholder="Phone" required="">
                        <label class="sr-only">Email</label>
                        <input name="email" type="email" class="form-control mt-4" placeholder="Email" required="">
                        <label class="sr-only">Country</label>
                        <select class="custom-select mt-4" name="country_id" required>
                            <option selected>Your country</option>
                            <?php
                            $query = query("SELECT * FROM countries");
                            confirm($query);
                            while ($row = fetch_array($query)) {
                                $country_id = $row['country_id'];
                                $country_name = $row['country_name'];

                                $country = <<<DELIMETER

                                  <option value="{$country_id}">{$country_name}</option>
                                  
DELIMETER;
                                echo $country;
                            }

                            ?>
                        </select>
                        <label class="sr-only">Are you ... .</label>
                        <select class="custom-select mt-4" name="category" required>
                            <option selected>Are you ... .</option>
                            <option value="Tourist">Tourist</option>
                            <option value="Instructor">Instructor</option>
                        </select>
                        <hr class="mt-4">
                        <button name="sign-up" class="btn btn-lg btn-primary btn-block" type="submit">Signup</button>
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