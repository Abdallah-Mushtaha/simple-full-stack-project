<?php
function rgister()
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/Regist.css">

    </head>

    <body class="regist">
        <div class="registWrrapper">
            <div class="div">

                <i class="fa-solid fa-hospital-user icon2"></i>


                <form action="" method="post" id="form2">


                    <label>
                        <h4>name </h4>
                        <input type="text" id="name" name="name" placeholder="Ali..." required>
                    </label>

                    <div>
                        <label>
                            <h4>Email</h4>
                            <input id="email" type="email" required name="email" placeholder="Ali@gmail.......">
                        </label>
                    </div>
                    <div id="box">
                        <label>
                            <h4>password</h4>
                            <input type="password" id="pass" name="password" placeholder="123456.." required>
                        </label>

                        <select name="type" id="sel">
                            <option value="Doctor" selected>Doctor</option>
                            <option value="pharmaceutical">pharmaceutical</option>
                        </select>

                    </div>
                    <label>
                        <h4>phone number</h4>
                        <input type="text" name="phone" id="phone" placeholder="05354646">
                    </label>

                    <input id="btn2" type="submit" name="creat" value=" creat " />

                </form>

            </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>


<?php
}
function Edite_Rgister($name = "", $email = "", $password = "", $type = "", $phone = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/Regist.css">
        <link rel="stylesheet" href="css/Style1.css">


    </head>
    <!--  صفحة تسجيل حساب للدكتور او الصيدلي -->

    <body class="regist">
        <div class="registWrrapper">
            <div class="div">

                <i class="fa-solid fa-hospital-user icon2"></i>


                <form action="" method="post" id="form2">


                    <label>
                        <h4>name </h4>
                        <input type="text" id="name" name="name" value="<?php echo $name ?>" placeholder="Ali..." required>
                    </label>

                    <div>
                        <label>
                            <h4>Email</h4>
                            <input id="email" type="email" required name="email" placeholder="Ali@gmail......." value="<?php echo $email ?>">
                        </label>
                    </div>
                    <small class="ErrorMS regist"><span>This email is already in use. <br> Choose another one * </span></small>
                    <div id="box">
                        <label>
                            <h4>password</h4>
                            <input type="password" id="pass" name="password" placeholder="123456.." required value="<?php echo $password ?>">
                        </label>

                        <select name="type" id="sel">
                            <option value="Doctor" <?php echo ($type == 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
                            <option value="pharmaceutical" <?php echo ($type == 'pharmaceutical') ? 'selected' : ''; ?>>pharmaceutical</option>
                        </select>

                    </div>
                    <label>
                        <h4>phone number</h4>
                        <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" placeholder="05354646">
                    </label>

                    <input id="btn2" type="submit" name="creat" value=" creat " />

                </form>

            </div>


        </div>



        <script src="./script.js"></script>
    </body>

    </html>


<?php
}

if (!isset($_POST["creat"])) {
    rgister();
} else {
    include "./DB_Files/regist_Logic.php";
}



?>