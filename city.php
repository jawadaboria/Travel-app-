<?php require_once("../config.php"); ?>


<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<?php

//Post function.
$user = $_SESSION['username'];

if (isset($_POST['post'])) {

    $username    =   $user;
    $city_id     =   escape_string($_GET['id']);
    $post        =   escape_string($_POST['post_value']);
    $date        =   date("d/m/y");

    $query = query("INSERT INTO posts(username,city_id,post,date) VALUES('{$username}','{$city_id}','{$post}','{$date}')");
    confirm($query);

    redirect("city.php?id={$city_id}");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Travel - Cities</title>
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

    <section class="bg-light">
        <div class="container px-4">
            <h4 class="text-center">Avalible Instructors</h4>
            <div class="row">
                <?php
                //Get cities from Database by URL id.
                $query = query("SELECT * FROM users WHERE country_id = " . escape_string($_GET['id']) . " AND category = 'Instructor'");
                confirm($query);

                if ($row = fetch_array($query)) {

                    $city_id = $row['city_id'];
                    $country_id = $row['country_id'];

                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $username = $row['username'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    $category = $row['category'];


                    $city = <<<DELIMETER

                <div class="col-md-3 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="small text-muted">Username : @{$username}</p>
                            <h5 class="card-title text-danger"> Name : <a class="text-dark">{$first_name} {$last_name}</a></h5>
                            <p class="text-success">Phone : <a class="text-dark">{$phone}</a></p>
                            <p class="text-warning">Email : <a class="text-dark">{$email}</a></p>
                            <hr>
                            <div class="row text-center">
                            <h6> Contact by </h6>
                            <div class="col">
                            <a href="mailto:{$email}" class="btn btn-warning">Mail</a>
                            </div>
                            <div class="col">
                            <a href="tel:{$phone}" class="btn btn-success">Phone</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                                  
DELIMETER;
                    echo $city;
                } else {
                    echo '<h1 class="text-danger text-center mt-4">Instructors list is empty for this city! </h1>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container px-4">
            <h4 class="text-center">Posts for this city</h4>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post">
                            <div class="form-group">
                                <label>Post a post :</label>
                                <textarea name="post_value" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <button name="post" type="submit" class="btn btn-success">Post</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <?php
                            //Get posts by city id.
                            $query = query("SELECT * FROM posts WHERE city_id = " . escape_string($_GET['id']) . " ");
                            confirm($query);

                            while ($row = fetch_array($query)) {
                                $username = $row['username'];
                                $post     = $row['post'];
                                $date     = $row['date'];

                                //Get user data by username.
                                $user_query = query("SELECT * FROM users WHERE username = '{$username}' ");
                                confirm($user_query);

                                while ($user_row = fetch_array($user_query)) {
                                    $phone = $user_row['phone'];
                                    $email = $user_row['email'];
                                    $category = $user_row['category'];
                                }

                                $post = <<<DELIMETER

                            <a class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{$username} - <span class="text-info small"> {$category}</span></h5>
                                    <small class="text-muted">{$date}</small>
                                </div>
                                <p class="mb-1">{$post}</p>
                                <small class="text-primary">Phone : {$phone} - Email : {$email}</small>
                            </a>
                                  
DELIMETER;
                                echo $post;
                            }
                            ?>
                        </div>
                    </div>
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