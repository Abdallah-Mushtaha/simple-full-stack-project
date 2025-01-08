<?php
include "./DB_Files/Connection_DB.php";

function validate($data)
{
    include "./DB_Files/Connection_DB.php";

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);

    return $data;
}

extract($_POST);

// جزئة فحص ما بدي الايميل يتكرر
$query_check_email = "SELECT * FROM users WHERE email = '" . $email . "' ";

$result_check_email = mysqli_query($con, $query_check_email);

if (mysqli_num_rows($result_check_email) > 0) {
    Edite_Rgister($name, $email, $password, $type, $phone);
    exit;
}

$name = validate($name);
$password = password_hash(validate($password), PASSWORD_BCRYPT);
$phone = validate($phone);
// password_hash(validate($password), PASSWORD_BCRYPT);





// الاجرائات العامه 
$query_user = "INSERT INTO users values('" . $email . "','" . $password . "','" . $type . "')";
$result = mysqli_query($con, $query_user);

if (strcmp("Doctor", $type) == 0) {
    $email = validate($email);

    $query_Doctor = "INSERT INTO doctors (name, email, password,phone_number) values('" . $name . "','" . $email . "','" . $password . "','" . $phone . "')";

    $result = mysqli_query($con, $query_Doctor);
    $last_ID = mysqli_insert_id($con);
} else {

    $query_pharmacists = "INSERT INTO pharmacists (name, email, password, phone_number) values('" . $name . "','" . $email . "','" . $password . "','" . $phone . "')";
    $result = mysqli_query($con, $query_pharmacists);
    $last_ID = mysqli_insert_id($con);
}
if ($result === false) {

    if (strtr(mysqli_error($con), $email)) {
        Edite_Rgister($name, $email, $password, $type, $phone);
    } else {
        echo "error " . mysqli_error($con);
    }
} else {
    if (strcmp("Doctor", $type) == 0) {
        header("Location:login.php");
    } else {
        header("Location:login.php");
    }
    echo "<h1>Done </h1> ";
}
