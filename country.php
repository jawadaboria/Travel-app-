<?php require_once("../config.php"); ?>


<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Travel - Countries</title>
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
            <h4 class="text-center">Select City</h4>
            <div class="row">
                <?php
                //Get cities from Database by URL id.
                $query = query("SELECT * FROM cities WHERE country_id = " . escape_string($_GET['id']) . "");
                confirm($query);
                while ($row = fetch_array($query)) {
                    $city_id = $row['city_id'];
                    $city_name = $row['city_name'];
                    $country_id = $row['country_id'];
                    $image = $row['image'];

                    //Get country name.
                    $country_query = query("SELECT * FROM countries WHERE country_id = {$country_id}");
                    confirm($country_query);
                    while ($country_row = fetch_array($country_query)) {
                        $country_name = $country_row['country_name'];
                    }

                    $city = <<<DELIMETER

                <div class="col-md-3 mt-4">
                    <div class="card">
                        <img width="300px" height="150px" class="card-img-top" src="{$image}" alt="Card image cap">
                        <div class="card-body">
                            <p class="small text-muted">Country : {$country_name}</p>
                            <h5 class="card-title">{$city_name}</h5>
                            <a href="city.php?id={$country_id}" class="btn btn-success float-right">Find instructor</a>
                        </div>
                    </div>
                </div>
                                  
DELIMETER;
                    echo $city;
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>