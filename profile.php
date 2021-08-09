<?php require_once("../config.php"); ?>


<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$user = $_SESSION['username'];

//Get user database function
$query = query("SELECT * FROM users WHERE username = '{$user}' ");
confirm($query);

while ($row = fetch_array($query)) {

    $first_name    =   $row['first_name'];
    $last_name     =   $row['last_name'];
    $username      =   $row['username'];
    $password      =   $row['password'];
    $phone         =   $row['phone'];
    $email         =   $row['email'];
    $country_id    =   $row['country_id'];
    $city_id       =   $row['city_id'];
    $category      =   $row['category'];

    $country_query = query("SELECT * FROM countries WHERE country_id = '{$country_id}' ");
    confirm($country_query);

    while ($country_row = fetch_array($country_query)) {
        $get_country_id = $country_row['country_id'];
        $country   =  $country_row['country_name'];
    }

    $city_query = query("SELECT * FROM cities WHERE city_id = '{$city_id}' ");
    confirm($city_query);

    while ($city_row = fetch_array($city_query)) {
        $city   =  $city_row['city_name'];
    }
}

//Update profile function.
if (isset($_POST['update-profile'])) {

    $first_name       = escape_string($_POST['first_name']);
    $last_name        = escape_string($_POST['last_name']);
    $username         = escape_string($_POST['username']);
    $password         = escape_string($_POST['password']);
    $phone            = escape_string($_POST['phone']);
    $email            = escape_string($_POST['email']);
    $country_id       = escape_string($_POST['country_id']);
    $city_id          = escape_string($_POST['city_id']);
    $category         = escape_string($_POST['category']);


    $query = "UPDATE users SET ";
    $query .= "first_name     = '{$first_name}'        , ";
    $query .= "last_name      = '{$last_name}'         , ";
    $query .= "username       = '{$username}'          , ";
    $query .= "password       = '{$password}'          , ";
    $query .= "phone          = '{$phone}'             , ";
    $query .= "email          = '{$email}'             , ";
    $query .= "country_id     = '{$country_id}'        , ";
    $query .= "city_id        = '{$city_id}'           , ";
    $query .= "category       = '{$category}'            ";

    $query .= "WHERE username= '{$user}'";


    $send_update_query = query($query);
    confirm($send_update_query);

    redirect("index.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Travel - Profile</title>
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">Travel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-danger small" href="logout.php">Signout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container col-6 px-4">
            <div class="row gx-4 justify-content-center">
                <form method="POST" class="form-signin">
                    <h1 class="mb-3 font-weight-normal text-center">Update Profile</h1>
                    <label class="mt-4">First name :</label>
                    <input name="first_name" type="text" class="form-control" placeholder="First name" value="<?php echo $first_name; ?>" required="" autofocus="">
                    <label class="mt-4">Last name :</label>
                    <input name="last_name" type="text" class="form-control" placeholder="Last name" value="<?php echo $last_name; ?>" required="">
                    <label class="mt-4">Username :</label>
                    <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo $username; ?>" required="">
                    <label class="mt-4">Password :</label>
                    <input name="password" type="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>" required="">
                    <label class="mt-4">Phone :</label>
                    <input name="phone" type="text" class="form-control" placeholder="Phone" value="<?php echo $phone; ?>" required="">
                    <label class="mt-4">Email :</label>
                    <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required="">
                    <label class="mt-4">Country :</label>
                    <select class="custom-select mt-4" name="country_id" required>
                        <option value="<?php echo $country_id; ?>" selected> - <?php echo $country; ?></option>
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

                    <label class="mt-4">City :</label>
                    <select class="custom-select" name="city_id" required>
                        <option value="<?php echo $city_id; ?>" selected> - <?php echo $city; ?></option>
                        <?php

                        //Get country id from user database to get the cities.
                        $query = query("SELECT * FROM cities WHERE country_id = '{$get_country_id}'");
                        confirm($query);
                        while ($row = fetch_array($query)) {

                            $city_id = $row['city_id'];
                            $city_name = $row['city_name'];

                            $city = <<<DELIMETER

                        <option value="{$city_id}">{$city_name}</option>
                                  
DELIMETER;
                            echo $city;
                        }

                        ?>
                    </select>
                    <label class="mt-4">Select a category :</label>
                    <select class="custom-select" name="category" required>
                        <option value="<?php echo $category; ?>"> - <?php echo $category; ?></option>
                        <option value="Tourist">Tourist</option>
                        <option value="Instructor">Instructor</option>
                    </select>
                    <hr class="mt-4">
                    <button name="update-profile" class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; Travel 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>