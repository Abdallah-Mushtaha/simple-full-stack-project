<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];

// واجهة اضافة مريض جديد  


function patinentRejest($id = "", $name = "", $email = "", $password = "", $Age = "", $date = "", $Gender = "", $phone = "", $problem = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>patinentForm</title>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/PationtForm.css">



    </head>

    <body class="patientbody">
        <div class="shadow">
            <div class="patinetWrrapper container">
                <div class="divForm">

                    <i class="fa-solid fa-hospital-user icon2"></i>


                    <form action="" method="post" id="form2">


                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <label>
                            <h4>name </h4>
                            <input type="text" name="name" placeholder="Ali..." required value="<?php echo $name ?>">
                        </label>


                        <div>
                            <label>
                                <h4>Email</h4>
                                <input id="email" type="email" required name="email" placeholder="Ali@gmail......." value="<?php echo $email ?>">
                            </label>
                        </div>
                        <div>
                            <label>
                                <h4>password</h4>
                                <input type="password" id="pass" name="password" placeholder="123456.." required value="<?php echo $password ?>">
                            </label>
                            <div>
                                <label>
                                    <h4>Age </h4>
                                    <input type="number" min="0" max="100" name="Age" placeholder="20" value="<?php echo $Age ?>" required>
                                </label>
                            </div>


                            <h4>Gender </h4>

                            <label for="Male" id="Ma">
                                <input type="radio" id="Male" name="Gender" value="Male" <?php echo ($Gender == 'Male') ? 'checked' : ''; ?> required>
                                Male
                            </label>

                            <label for="Femal" id="Fe">
                                <input type="radio" id="Female" name="Gender" value="Female" <?php echo ($Gender == 'Female') ? 'checked' : ''; ?> required>
                                Female
                            </label>




                        </div>
                        <div>
                            <label>
                                <h4>phone number</h4>
                                <input type="text" name="phone" id="phone" placeholder="05354646" value="<?php echo $phone ?>">
                            </label>
                        </div>
                        <div>
                            <label>
                                <h4>Date</h4>
                                <input type="date" name="date" id="date" placeholder="05354646" value="<?php echo $date ?>">
                            </label>
                        </div>



                        <label>
                            <h4>Problem</h4>
                            <textarea required name="problem" id="textarea" rows="10" placeholder=" I fell ......."><?php echo $problem ?></textarea>
                        </label>


                        <input id="btn2" type="submit" name="creat" value=" creat " />

                    </form>

                </div>
            </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>


<?php
}
function patinentRejest_Edite($name = "", $email = "", $password = "", $Age = "", $date = "", $Gender = "", $phone = "", $problem = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>patinentForm</title>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/pationtForm.css">
        <link rel="stylesheet" href="./css/Style1.css">




    </head>

    <body class="patientbody">
        <div class="shadow">
            <div class="patinetWrrapper container">
                <div class="divForm">

                    <i class="fa-solid fa-hospital-user icon2"></i>


                    <form action="" method="post" id="form2">


                        <label>
                            <h4>name </h4>
                            <input type="text" name="name" placeholder="Ali..." value="<?php echo $name ?>" required>
                        </label>


                        <div>
                            <label>
                                <h4>Email</h4>
                                <input id="email" type="email" required name="email" placeholder="Ali@gmail......." value="<?php echo $email ?>">
                            </label>
                        </div>
                        <small class="ErrorMS regist"><span>This email is already in use. <br> Choose another one * </span></small>
                        <div>
                            <label>
                                <h4>password</h4>
                                <input type="password" id="pass" name="password" value="<?php echo $password ?>" placeholder="123456.." required>
                            </label>
                            <div>
                                <label>
                                    <h4>Age </h4>
                                    <input type="number" min="0" max="100" name="Age" placeholder="20" value="<?php echo $Age ?>" required>
                                </label>
                            </div>


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




                        </div>
                        <div>
                            <label>
                                <h4>phone number</h4>
                                <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" placeholder="05354646">
                            </label>
                        </div>
                        <div>
                            <label>
                                <h4>Date</h4>
                                <input type="date" name="date" id="date" value="<?php echo $date ?>" placeholder="05354646">
                            </label>
                        </div>



                        <label>
                            <h4>Problem</h4>
                            <textarea required name="problem" id="textarea" rows="10" placeholder=" I fell ......."><?php echo $problem ?></textarea>
                        </label>



                        <input id="btn2" type="submit" name="creat" value=" creat " />

                    </form>


                </div>
            </div>
        </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>


<?php
}

if (!isset($_POST["creat"])) {
    if (isset($_POST["Edite"])) {
        extract($_POST);
        patinentRejest($id, $name, $email, substr($password, 0, 10), $age, $entranceDate, $gender, $phone, $problem);
    } else {
        patinentRejest();
    }
} else {

    include "./DB_Files/patientForm_logic.php";
}


?>





















<!-- 
if (!isset($_GET["creat"])) {
    if (empty($_GET)) {
        rgister();
    } else {
        extract($_GET);
        rgister($id, $name,  $email, $password, $phone, $problem);
    }
} else {
    print_r($_GET);
    header("Location: docPage.php");
}
 -->