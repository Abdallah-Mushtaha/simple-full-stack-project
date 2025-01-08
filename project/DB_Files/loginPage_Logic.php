<?php
session_start();


function validate($data)
{
    include "./DB_Files/Connection_DB.php";

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);

    return $data;
}

$query_user = "SELECT * from users";
$result = mysqli_query($con, $query_user);
if ($result === false) {
    echo "error " . mysqli_error($con);
} else {
    $email = validate($email);
    $password = validate($password);



    while ($row = $result->fetch_assoc()) {

        if ((strcmp($email, $row["email"]) == 0) && (password_verify($password, $row["password"])) && (strcmp($row["type"], "Doctor") == 0)) {

            // عشان اصل لبيانات الشخص واخزنها ب سيشن 

            $record = "SELECT * from doctors WHERE email='$email' ";
            $result_data = mysqli_query($con, $record);
            if ($result_data->num_rows > 0) {
                $row = $result_data->fetch_assoc();
                $_SESSION["user_Data"] = $row;
            }

            header("Location: docPage.php");
            die();
        } elseif ((strcmp($email, $row["email"]) == 0) && (password_verify($password, $row["password"])) && (strcmp($row["type"], "pharmaceutical") == 0)) {
            // عشان اصل لبيانات الشخص واخزنها ب سيشن 

            $record = "SELECT * from pharmacists WHERE email='$email' ";
            $result_data = mysqli_query($con, $record);
            if ($result_data->num_rows > 0) {
                $row = $result_data->fetch_assoc();
                $_SESSION["user_Data"] = $row;
            }

            header("Location:PharmPage.php");
            die();
        } elseif ((strcmp($email, $row["email"]) == 0) && (password_verify($password, $row["password"])) && (strcmp($row["type"], "patient") == 0)) {

            // عشان اصل لبيانات الشخص واخزنها ب سيشن 

            $record = "SELECT * from patients WHERE email='$email' ";
            $result_data = mysqli_query($con, $record);
            if ($result_data->num_rows > 0) {
                $row = $result_data->fetch_assoc();
                $_SESSION["user_Data"] = $row;
            }

            header("Location: patientPage.php");
            die();
        }
    }
    loginEdite($email, $password);
}
