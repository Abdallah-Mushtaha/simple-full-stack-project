<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];
$user_name = $_SESSION["user_Data"]["name"];
$user_email = $_SESSION["user_Data"]["email"];
$user_password = $_SESSION["user_Data"]["password"];
$user_age = $_SESSION["user_Data"]["age"];
$user_Gender = $_SESSION["user_Data"]["gender"];
$user_phoneNumber = $_SESSION["user_Data"]["phoneNumber"];

// echo "<h1>$user_id</h1>"; // للتجربه 

// واجهة الخاصة بتعديل بيناتي ك مريض  

function Edite_Patient_Info($id = "", $name = "", $email = "", $password = "", $age = "", $Gender = "", $phoneNumber = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Patient Info</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/editePatient.css">
    </head>

    <body>


        <div class="wrrapper">
            <div> <i class="fa-solid fa-pen-to-square"></i></div>
            <h2>Edite_Patient_Info</h2>

            <form action="./DB_Files/Edite_patient_info_Logic.php" method="post">

                <input type="hidden" name="id" value="<?php echo $id ?>">

                <label>
                    <h4> name</h4>
                    <input type="text" name="name" value="<?php echo $name ?>">
                </label>
                <label>
                    <h4> email</h4>
                    <input type="email" name="email" value="<?php echo $email ?>">
                </label>
                <label>
                    <h4> password</h4>
                    <input type="password" name="password" value="<?php echo $password ?>">
                </label>
                <label>
                    <h4> Age</h4>
                    <input type="number" min="0" max="100" name="age" value="<?php echo $age ?>">
                </label>
                <label>
                    <h4>Gender </h4>


                    <label for="Male" id="Ma">
                        <input type="radio" id="Male" name="Gender" value="Male" <?php echo ($Gender == "Male") ? 'checked' : ''; ?>
                            required>
                        Male
                    </label>

                    <label for="Femal" id="Fe">
                        <input type="radio" id="Femal" name="Gender" value="Femal" <?php echo ($Gender == "Femal") ? 'checked' : ''; ?>
                            required>
                        Femal
                    </label>


                </label>

                <label>
                    <h4> phone Number</h4>
                    <input type="text" name="phone" value="<?php echo $phoneNumber ?>">
                </label>

                <input type="submit" name="Edite" value="Edite">
                <a href="./info.php" id="btn"> cancel</a>

            </form>
        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
}

if (isset($_POST["Edite"])) {
    // extract($_POST);
    header("Location: ./DB_Files/Edite_patient_info_Logic.php");

    // header("Location:./info.php");
} else {
    if ($_GET) {
        print_r($_GET);
    }
    Edite_Patient_Info(
        $user_id,
        $user_name,
        $user_email,
        substr($user_password, 0, 10),
        $user_age,
        $user_Gender,
        $user_phoneNumber
    );
}


?>