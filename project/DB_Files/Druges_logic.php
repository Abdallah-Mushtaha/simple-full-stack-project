<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];
// echo "<h1>$user_id</h1>";
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
$dosage = validate($dosage);
$date = validate($date);
$Expired = validate($Expired);


/* كود تعديل دواء قديم  */
/*
                                                                            سيناريو التعديل               

 جزئية التعديل ال هيصير اذا ضغط تعديل رح يبعت البيانات لصفحة  جدول الادويه مع الاي دي   ينعرضو ثم اذا ضغط انشاء  رح يجي هنا رح افحص الاي دي  موجود ف جدول الادويه اذا اه  رح اعمل تعديل على جدول الادويه

*/

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $query = "SELECT *  FROM drugs  WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if ($result == true) {
        $query_update = "UPDATE drugs SET 
    name = '$name', 
    dosage = '$dosage', 
    productionDate = '$date', 
    expiryDate = '$Expired' 
 WHERE id = '$id'";

        $result_update = mysqli_query($con, $query_update);
        if ($result_update == true) {
            header("Location:pharmPage.php");
        }
        die();
    } else {
        echo "Not found Druge to Edite";
    }
}



//*************************************************************************** */
// كود اضافة دواء جديد 

$ADDition_query = "INSERT INTO drugs(name, dosage, productionDate,expiryDate,pharmacists_id) values('" . $name . "','" . $dosage . "','" . $date . "','" . $Expired . "','$user_id')";
$ADDition_result = mysqli_query($con, $ADDition_query);
// $last_ID = mysqli_insert_id($con);
if ($ADDition_result === false) {
    echo "error ";
} else {
    header("Location:./PharmPage.php");
}
/**************************************************************************************** */
// عملية الاضافه على جدول ال patientDoctor
// $last_id = $con->insert_id;
// $pharmacistdrug_query = "INSERT INTO pharmacistdrug(pharm_id ,drug_id)values($user_idو$last_id)";
// $pharmacistdrug_Result  = mysqli_query($con, $pharmacistdrug_query);
// if ($pharmacistdrug_Result == false) {
//     echo "Error" . mysqli_error($con);
// }
