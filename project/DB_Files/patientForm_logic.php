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

$name = validate($name);
$email = validate($email);
$password = password_hash(validate($password), PASSWORD_BCRYPT);
$Age = validate($Age);
$Gender = validate($Gender);
$problem = validate($problem);
$date = validate($date);
$phone = validate($phone);



/*
                                                                            سيناريو التعديل               

 جزئية التعديل ال هيصير اذا ضغط تعديل رح يبعت البيانات لصفحة  جدول المريض مع الاي دي   ينعرضو ثم اذا ضغط انشاء  رح يجي هنا رح افحص الايميل  موجود ف جدول المستخدم اذا اه  رح اخد نسخه منه ثم اعمل تعديل على جدول المريض ثم تعديل على جدول ال مستخدمين بناء على الاي دي وجدول المستخدم التعديل بناء على الايميل القديم 

*/
if (isset($id)) {
    $old_email_query = "SELECT email FROM patients WHERE id = '$id'";
    $old_email_result = mysqli_query($con, $old_email_query);

    if ($old_email_result && mysqli_num_rows($old_email_result) > 0) {
        $old_email_row = mysqli_fetch_assoc($old_email_result);
        $old_email = $old_email_row['email'];

        $query_update1 = "UPDATE patients SET 
                        name = '$name', 
                        email = '$email', 
                        password = '$password', 
                        age = '$Age', 
                        gender = '$Gender', 
                        problem = '$problem', 
                        entranceDate = '$date', 
                        phoneNumber = '$phone' 
                     WHERE id = '$id'";

        $result_update1 = mysqli_query($con, $query_update1); // خاصه بجدول المرضى

        if ($result_update1) {
            // باستخدام الايميل القديم لجدول المستخدم رح احدث البيانات 
            $query_update2 = "UPDATE users SET 
                            email = '$email', 
                            password = '$password' 
                         WHERE email = '$old_email'";

            $result_update2 = mysqli_query($con, $query_update2); // خاصه بجدول المستخدمين

            if ($result_update2) {
                // إذا تمت جميع التحديثات بنجاح
                header("Location: ./docPage.php");
                exit();
            } else {
                if (isset($_POST["Edite"])) {
                    echo "Error updating users table: " . mysqli_error($con);
                }
            }
        } else {
            if (isset($_POST["Edite"])) {
                echo "Error updating patients table: " . mysqli_error($con);
            }
        }
    } else {
        if (isset($_POST["Edite"])) {
            echo "Error fetching old email: " . mysqli_error($con);
        }
    }
} else {
    header("Location: ./patientForm.php");
}


//********************************************************************/



//                    جزئة فحص ما بدي الايميل يتكرر عشان اذا في تكرار وهو بسجل مريض جديد يرجعو على الواجهة يقولو  هذا الايميل مستخدم

$query_check_email = "SELECT * FROM patients WHERE email = '" . $email . "' ";
$query_check_email = "SELECT * FROM users WHERE email = '" . $email . "' ";

$result_check_email = mysqli_query($con, $query_check_email);

if (mysqli_num_rows($result_check_email) > 0) {
    patinentRejest_Edite($name, $email, $password, $Age, $date, $Gender, $phone, $problem);
    exit;
}

//********************************************************************/

//  عمليه الاضافة لمريض جديد ف الجدول  المريض وجدول المستخدمين

$query_user = "INSERT INTO users values('" . $email . "','" . $password . "','patient')";
$result = mysqli_query($con, $query_user);


$query = "INSERT INTO patients values('" . $id . "','" . $name . "','" . $email . "','" . $password . "','" . $Age . "','" . $Gender . "','" . $problem . "', '" . $date . "' ,'" . $phone . "')";

$result = mysqli_query($con, $query);
if ($result === false) {
    echo "error ";
} else {
    header("Location:./docPage.php");
    echo "<h1>Done </h1> ";
}

/**************************************************************************************** */
// عملية الاضافه على جدول ال patientDoctor
$last_id = $con->insert_id;
$patientDoctor_query = "INSERT INTO patientdoctor(pat_id ,doc_id)values($last_id,$user_id)";
$patientDoctor_Result = mysqli_query($con, $patientDoctor_query);
if ($patientDoctor_Result == false) {
    echo "Error" . mysqli_error($con);
}
