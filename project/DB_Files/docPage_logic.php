<?php


include "./DB_Files/Connection_DB.php";




/*                             سيناريو الحذف 
 رح يصلك  الاي دي اول ما يعمل حذف من خلاله رح اجيب ال ايميل واحذف البيات من الجدول المرضى باستخدام ال اي دي وجدول المستخدمين من خلال الايميل رح احذف  

*/
if (isset($_GET["delet"]) && !empty($_GET["id"])) {
    $patientId = intval($_GET["id"]); // تحويل id إلى رقم

    // استعلام لحذف السجلات المرتبطة بالمريض في جدول patientdrug
    $delete_PatientDrug_Query = "DELETE FROM patientdrug WHERE pat_id = '$patientId'";
    $delete_PatientDrug_Result = mysqli_query($con, $delete_PatientDrug_Query);

    if ($delete_PatientDrug_Result) {
        // استعلام لحذف المريض من جدول patients
        $patient_Info = "SELECT * FROM patients WHERE id = '$patientId'";
        $result = mysqli_query($con, $patient_Info);

        if ($result && mysqli_num_rows($result) > 0) {
            $record = mysqli_fetch_assoc($result);
            $email = $record['email']; // استخراج الإيميل من سجل المريض

            // استعلام لحذف المستخدم بناءً على الإيميل
            $delete_User_Query = "DELETE FROM users WHERE email = '$email'";
            $delete_U_Result = mysqli_query($con, $delete_User_Query);

            if ($delete_U_Result) {
                // الآن حذف المريض
                $deleteQuery = "DELETE FROM patients WHERE id = '$patientId'";
                $deleteResult = mysqli_query($con, $deleteQuery);

                if ($deleteResult) {
                    header("Location:docPage.php"); // إعادة التوجيه بعد الحذف
                    exit();
                } else {
                    echo "Error deleting from patients table: " . mysqli_error($con);
                }
            } else {
                echo "Error deleting from users table: " . mysqli_error($con);
            }
        } else {
            echo "No patient found with the provided ID.";
        }
    } else {
        echo "Error deleting from patientdrug table: " . mysqli_error($con);
    }
}

// نهايه كود الحذف 
//************************************************************************************** */

$query = "
    SELECT p.* 
    FROM patients p
    INNER JOIN patientdoctor pd ON p.id = pd.pat_id
    WHERE pd.doc_id = $user_id";
$result = mysqli_query($con, $query);
if ($result === false) {
    echo "Error";
} else {
    echo "<tr>";

    while ($row = mysqli_fetch_assoc($result)) {

        // عشان اجيب الادويه ال اخترتها للهذا المريض 
        $drug_query = "SELECT d.name 
                       FROM drugs d
                       INNER JOIN patientdrug pd ON d.id = pd.drug_id
                       WHERE pd.pat_id = " . $row["id"];
        $drug_result = mysqli_query($con, $drug_query);
        $drugs = []; // عملت هي الاري عشان اخزن فيها اسماء الادويه
        while ($drug_row = mysqli_fetch_assoc($drug_result)) {
            $drugs[] = $drug_row['name'];
        }

?>
        <div class="row   justify-content-center ">
            <div class="col-md-10 ">
                <div class="wrapper ">
                    <div class="box">



                        <div class="title"> <small id="id"><?php echo  "#", $row["id"], " :: " ?></small>
                            <small id="name"><?php echo  $row["name"] ?></small>
                        </div>
                        <div class="wrapper-info">
                            <div id="email"><?php echo "<span>Email :: </span> ", $row["email"] ?></div>
                            <div id="password"><?php echo "<span>password :: </span>",  substr($row["password"], 0, 10)  ?></div>
                            <div id="age"><?php echo "<span>age :: </span>",  $row["age"] ?></div>
                            <div id="gender"><?php echo  "<span>gender :: </span> ", $row["gender"] ?></div>
                            <div id="problem"><?php echo "<span>problem :: </span> ",  $row["problem"] ?></div>
                            <div id="entranceDate"><?php echo  "<span>entranceDate :: </span> ",  $row["entranceDate"] ?></div>
                            <div id="phoneNumber"><?php echo "<span>phoneNumber :: </span> ",  $row["phoneNumber"] ?></div>
                            <span>drugs :: </span>
                            <td>
                                <!-- عشان اعرض الادويه بطريقه  ليست-->
                                <ul>
                                    <?php

                                    foreach ($drugs as $drug) {
                                        echo "<li>" . htmlspecialchars($drug) . "</li>";
                                    }
                                    ?>
                                </ul>
                            </td>
                        </div>
                        <td>
                            <div class="btn-wrapper d-flex  justify-content-center align-items-center gap-2">
                                <!--                                    زر الحذف
                  رح يصير كود الحذف بنفس الصفحه ورح يبعت ال اي دي ومن خلاله بجيب الايميل  وبحذف من جدول المستخدمين ومن خلال الاي دي بحذف من جدول المريض 
                -->
                                <form action="" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                    <input type="submit" name="delet" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?');">
                                </form>

                                <!--   زر التعديل
            pationt form Logic   رح ابعت البيانات ال لازمه  لصفحه ورح يصير السيناريو ال ذكرتو بصفحة ال -->
                                <form action="./patientForm.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>">
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($row["email"]); ?>">
                                    <input type="hidden" name="age" value="<?php echo htmlspecialchars($row["age"]); ?>">
                                    <input type="hidden" name="gender" value="<?php echo htmlspecialchars($row["gender"]); ?>">

                                    <input type="hidden" name="entranceDate" value="<?php echo htmlspecialchars($row["entranceDate"]); ?>">

                                    <input type="hidden" name="password" value="<?php echo htmlspecialchars($row["password"]); ?>">
                                    <input type="hidden" name="problem" value="<?php echo htmlspecialchars($row["problem"]); ?>">
                                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($row["phoneNumber"]); ?>">
                                    <input type="submit" name="Edite" class="btn btn-primary" value="Edit">

                                    <a class="btn btn-success" href="./ADD_DrugeUI.php?Patient_id=<?php echo htmlspecialchars($row["id"]); ?>" id="AddDruge">Add Drug</a>
                                </form>

                        </td>

                        </tr>
                    </div>
                </div>
            </div>
        </div>
        </div>


<?php

    }
    die();
}






?>