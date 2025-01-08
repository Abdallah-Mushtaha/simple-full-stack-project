<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];

// echo "<h2>$user_id</h2>"; //تجربه للتاكد انو وصل  
function doctor_table()
{
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/DocPage.css">

        <title>Doctor</title>
    </head>

    <body>
        <!-- صفحة الدكتور ال هينعرض فيها المرضى الخاصين فيه  -->

        <nav class="navbar bg-body-tertiary mb-5">
            <div class="container-fluid">
                <a class="navbar-brand">Doctor</a>
                <form class="d-flex gap-2" role="search">
                    <a href="./login.php" class="btn btn-outline-success" type="submit">Logout</a>
                    <a href="./PatientForm.php?user_id=<?php global $user_id;
                                                        echo  $user_id ?>" class="btn btn-outline-success" type="submit">Add Patient</a>


                </form>
            </div>
        </nav>

        <div class="cont">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">problem</th>
                        <th scope="col">Date</th>
                        <th scope="col">phone Number</th>
                        <th scope="col">Druge</th>
                        <th scope="col">option</th>


                    </tr>
                </thead>
                <tbody>


                    <?php
                    include "./DB_Files/docPage_logic.php";
                    ?>



                </tbody>
            </table>
        </div>



    </body>

    </html>




<?php
}



doctor_table();







?>