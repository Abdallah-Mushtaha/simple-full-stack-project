<?php
// session_start();
// $user_id = $_SESSION["user_Data"]["id"];
// user_id global $user_id;
//                                                     echo  $user_id 
// echo "<h2>$user_id</h2>"; //تجربه للتاكد انو وصل  

function doctor_table()
{
?>
    <!--    صفحة لمن ادخل ك صيدلي رح يعرض كل الادويه ال فداتا بيز وال رح تنضاف  عملت نظام يعرض الادويه
         ال دخلها  الصيدلي نفسه وليس كل الادويه ال ف الداتا بيز  -->

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/docPage.css">

        <title>Druges</title>
    </head>

    <body>
        <header>
            <nav class="navbar bg-body-tertiary mb-5">
                <div class="container-fluid">
                    <a class="navbar-brand">Druges</a>
                    <div class="d-flex gap-2" role="search">
                        <a href="./login.php" class="btn btn-outline-success" type="submit">Logout</a>
                        <a href="./Druges.php" class="btn btn-outline-success" type="submit">Add Druge</a>

                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="cont my-5 ">
                <div class="wrapper container">
                    <h2 class=" py-3">pharmaceutical :: </h2>
                    <tbody>

                        <?php
                        include "./DB_Files/pharmPage_logic.php";
                        ?>



                    </tbody>
                    </table>
                </div>
            </div>

            <div class="dd"></div>

        </main>

        <!-- <div class="cont">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">dosage</th>
                        <th scope="col">proudacut Date</th>
                        <th scope="col">Expired</th>
                        <th scope="col">pharmistic_ID</th>
                        <th scope="col">optiones</th>




                    </tr>
                </thead>
                <tbody>




                </tbody>
            </table>
        </div> -->



    </body>

    </html>




<?php
}

doctor_table();








?>