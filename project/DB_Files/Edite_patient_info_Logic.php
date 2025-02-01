<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];

include "Connection_DB.php";

if (isset($_SESSION["user_Data"]) != true) {
    header("Location:./info.php");
}


function validate($data)
{
    include "Connection_DB.php";

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);

    return $data;
}


// تحديث البيانات 

extract($_POST);
$password = password_hash(validate($password), PASSWORD_BCRYPT);


// var_dump($_POST);

$old_email_query = "SELECT email FROM patients WHERE id = '$id'";
$old_email_result = mysqli_query($con, $old_email_query);

if ($old_email_result && mysqli_num_rows($old_email_result) > 0) {
    $old_email_row = mysqli_fetch_assoc($old_email_result);
    $old_email = $old_email_row['email'];

    $query_update1 = "UPDATE patients SET 
                        name = '$name', 
                        email = '$email', 
                        password = '$password', 
                        age = '$age', 
                        gender = '$Gender', 
                        phoneNumber = '$phone' 
                     WHERE id = '$id'";
    /*هنا عشان ارجع اعمل ريفرش للداتا عشان لو رح يعمل تعديل كمان مره رح يعرض البيانات القديمه ليه عشان رح يعرض بيانات السيشن القديم اول ما دخل ف عشان هيك بعمل هل حركه 
    */
    session_start();
    $_SESSION["user_Data"]["id"] = $id;
    $_SESSION["user_Data"]["name"] = $name;
    $_SESSION["user_Data"]["email"] = $email;
    $_SESSION["user_Data"]["password"] = $password;
    $_SESSION["user_Data"]["age"] = $age;
    $_SESSION["user_Data"]["gender"] = $Gender;
    $_SESSION["user_Data"]["phoneNumber"] = $phone;

    $result_update1 = mysqli_query($con, $query_update1); // تحديث بيانات المرضى

    if ($result_update1) {
        // باستخدام الايميل القديم لجدول المستخدم لتحديث البيانات 
        $query_update2 = "UPDATE users SET 
                            email = '$email', 
                            password = '$password' 
                         WHERE email = '$old_email'";

        $result_update2 = mysqli_query($con, $query_update2); // تحديث بيانات المستخدمين

        if ($result_update2) {
            // إذا تمت جميع التحديثات بنجاح
            header("Location:../info.php");

            exit();
        } else {
            echo "Error updating users table: " . mysqli_error($con);
        }
    } else {
        echo "Error updating patients table: " . mysqli_error($con);
    }
} else {
    echo "Error when get old email: " . mysqli_error($con);
}
