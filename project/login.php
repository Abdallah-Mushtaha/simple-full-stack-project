<?php
function login()
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body class="loginPage">

        <div class="loginWrrapper">
            <form action="" method="post">
                <i class="fa-solid fa-user icon1"></i>
                </svg>
                <label>
                    Email
                    <input type="email" required name="email" placeholder="Name@gmai.....">
                </label>
                <label>
                    password
                    <input type="password" required name="password" placeholder="123456.....">
                    <p><a id="regist" href="./regist.php">create account </a></p>
                </label>

                <input type="submit" id="btn" name="login" value="login">

            </form>
        </div>
        <script src="./script.js"></script>
    </body>

    </html>


<?php
}
function loginEdite($email = "", $password = "")
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <!--  صفحة ال تسجيل الدخول  -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/Style1.css">

    </head>

    <body class="loginPage">

        <div class="loginWrrapper">
            <form action="" method="post" id="form">
                <i class="fa-solid fa-user icon1"></i>
                </svg>
                <label class="EditeLable">
                    Email
                    <input type="email" required name="email" placeholder="Name@gmai....." value="<?php echo $email ?>">
                    <small class="ErrorMS"><span>Make sure you entered the correct email </span><span class="star">*</span></small>

                </label>
                <label class="EditeLable">
                    password
                    <input type="password" required name="password" placeholder="123456....." value="<?php echo $password ?>">
                    <small class="ErrorMS"> <span>Make sure you entered the correct password </span><span class="star">*</span> </small>
                    <p><a id="regist" href="./regist.php">create account </a></p>
                </label>

                <input type="submit" id="btn" name="login" value="login">

            </form>
        </div>
        <script src="./script.js"></script>
    </body>

    </html>


<?php
}
if (!isset($_POST["login"])) {
    login();
} else {
    extract($_POST);
    include "./DB_Files/Connection_DB.php";
    include "./DB_Files/loginPage_Logic.php";
}




?>