<?php
function backdata()
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/Info.css">

    </head>

    <!--  صفحة ال رح ينعرض فيها بيانات المريض ال دخل على النظام   ايش الادويه تعونو ولو رح يعدل على بياناته -->

    <body class="info">
        <div class="infoWrrapper">

            <div class="div">

                <i class="fa-solid fa-user "></i>

                <div class="info">
                <?php
                include "./DB_Files/info_logic.php";
            }
                ?>
                <div class="btns">
                    <a href="./patientPage.php" class="btn btn-dark" type="submit">Back</a>

                    <a href="./Edite_patient_info.php" class="btn btn-success " type="submit">Eidet</a>


                </div>


                </div>




            </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>
    <?php
    backdata();

    ?>