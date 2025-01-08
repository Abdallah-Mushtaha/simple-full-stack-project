<?php
// session_start();
// $user_id = $_SESSION["user_Data"]["id"];
// echo "<h1>$user_id</h1>";


//   صفحة دخولي كمريض 

function patient_table()
{
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/docPage.css">
        <link rel="stylesheet" href="./css/pationtPage.css">


        <title>Doctor</title>
    </head>

    <body>

        <nav class="navbar bg-body-tertiary mb-5">
            <div class="container-fluid">
                <a class="navbar-brand">PatientPage</a>
                <div class="d-flex gap-3">

                    <a href="./info.php" type="submit"><i class="fa-solid fa-user"></i></a>
                    <a href="./login.php" class="btn btn-outline-success " type="submit">Logout</a>

                </div>
            </div>
        </nav>

        <div class="cont">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">dosage</th>
                        <th scope="col">proudacutDate</th>
                        <th scope="col">Expired</th>




                    </tr>
                </thead>
                <tbody>

                    <!--  استرجاع مع نقل عند الضغط على تعديل -->
                    <?php
                    include "./DB_Files/patientPage_logic.php";

                    ?>




        </div>



    </body>

    </html>




<?php
}

patient_table();
// print_r($_POST);








?>