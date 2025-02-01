<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];
if (isset($_SESSION["user_Data"]) != true) {
    header("Location:./PharmPage.php");
}

function rgister($id = "", $name = "", $dosage = "", $proudacutDate = "", $Expired = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Druges</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/druges.css">


    </head>
    <!--  صفحة اضافة الادويه  -->

    <body class="druges ">
        <div class="drugesWrrapper">
            <div class="div">
                </i><i class="fa-solid fa-capsules icon2"></i>


                <form action="" method="post" id="form2">

                    <input type="hidden" name="id" value="<?php echo $id ?>">


                    <label>
                        <h4>name </h4>
                        <input type="text" name="name" placeholder="Ali..." value="<?php echo $name ?>" required>
                    </label>

                    <div>
                        <label>
                            <h4>dosage</h4>
                            <input id="dosage" type="number_format" required placeholder="12.5" name="dosage" value="<?php echo $dosage ?>">
                        </label>
                    </div>
                    <div>
                        <label>
                            <h4>proudacutDate</h4>
                            <input id="date" type="date" required name="date" value="<?php echo $proudacutDate ?>">
                        </label>
                    </div>
                    <div>
                        <label>
                            <h4>Expired</h4>
                            <input type="date" id="expir" name="Expired" value="<?php echo $Expired ?>" required>
                        </label>


                    </div>

                    <input id="btn2" type="submit" name="ADD" value=" ADD " />


                </form>
                <a href="./pharmPage.php" id="cancel"> Cancel</a>



            </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>


<?php
}
if (!isset($_POST["ADD"])) {
    if (isset($_POST["Edite"])) {
        extract($_POST);
        rgister($id, $name, $dosage, $productionDate, $expiryDate);
    } else {
        rgister();
    }
} else {
    include "./DB_Files/Druges_logic.php";
}





?>