<?php
session_start();

// بدي اتحقق موجود ول لا Patient_id

if (isset($_GET["Patient_id"])) {
    $_SESSION["Patient_id"] = $_GET["Patient_id"];
}

if (isset($_SESSION["Patient_id"])) {
    $Patient_id = $_SESSION["Patient_id"];
    echo "<h1>Patient ID: $Patient_id</h1>";
} else {
    echo "Patient ID is not set.";
    exit();
}
if (isset($_SESSION["user_Data"]) != true) {
    header("Location:./docPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/aDD_DrugeUI.css">
    <title>ADD_Druge</title>
</head>

<body>

    <!--  كثير ف حتيطوا بنفس الصفحه  html هي الصفحة خاصه باضافة الادويه لمريض معين   مافيها كود   -->

    <div>
        <label id="selWrap">
            <h4>Drug</h4>

            <?php
            include "./DB_Files/Connection_DB.php";


            //  patientdrug في حال حدد ادويه قبل هيك  رح انشئ اري اخزن فيها كل اي دي تبع كل دواء من جدول

            $selected_query = "SELECT drug_id FROM patientdrug WHERE pat_id = $Patient_id";
            $selected_result = mysqli_query($con, $selected_query);

            $selected_drugs = [];

            while ($row = mysqli_fetch_assoc($selected_result)) {
                $selected_drugs[] = $row['drug_id'];
            }

            // **********************************************************
            /*  هنا رح اجيب الادويه من جدول الادويه عشان اعرضهم من داتا بيز  للواجهة*/

            $query = "SELECT * FROM drugs";
            $result = mysqli_query($con, $query);
            if ($result === false) {
                echo "Error: " . mysqli_error($con);
            } else {
            ?>
                <form action="" method="get">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $drug_id = htmlspecialchars($row["id"]);
                        $is_checked = in_array($drug_id, $selected_drugs) ? 'checked' : '';
                    ?>
                        <label class="sel">
                            <input type="checkbox" name="medications[]" value="<?php echo $drug_id; ?>" <?php echo $is_checked; ?>>
                            <?php echo htmlspecialchars($row["name"]);  ?>
                        </label>
                        <br>
                    <?php
                    }
                    ?>
                    <input type="submit" name="Save" value="Save">
                </form>
            <?php
            }


            if (isset($_GET["Save"])) {
                if (!empty($_GET["medications"])) {
                    $selected_medications = $_GET["medications"];

                    // في حال والله لغيت التشيك عن دوا رح الغيه من  هذا المريض يعني هيبطل معطى هذا الدواء لهذا المريض
                    /*implode اتعرفت عليها تستخدم لدمج عناصر المصفوفة مع بعض وتحولهم لنص 
array_map تعرفت عليها خلال المشروع بتعمل تعديل على اري  يعني بتاخد اري وبترجع اري بتمر على كل عنصر عشان تعدل 
in_array تفحص هل موجود ف الاري وهكذا 
                    */
                    $delete_query = "DELETE FROM patientdrug WHERE pat_id = $Patient_id AND drug_id NOT IN (" . implode(",", array_map('intval', $selected_medications)) . ")";
                    mysqli_query($con, $delete_query);

                    // في حال حدد ادويه جديده رح اضيفها 
                    foreach ($selected_medications as $drug_id) {

                        // طبعا رح احط بعين الاعتبار انو هل هذا الدوا انظاف قبل هيك ول لا
                        /*in_array استخدمتها عشان اتحقق هل موجود الدوا ف الاري ول لا   
                        فقلت طالما مش موجود 
             نفذ الكود 
                        */
                        if (!in_array($drug_id, $selected_drugs)) {
                            $Addition_query = "INSERT INTO patientdrug(pat_id, drug_id) VALUES($Patient_id, $drug_id)";
                            $Addition_Result = mysqli_query($con, $Addition_query);

                            if ($Addition_Result) {
                                echo "Medication added successfully: " . htmlspecialchars($drug_id) . "<br>";
                            } else {
                                echo "Error adding medication: " . mysqli_error($con) . "<br>";
                            }
                        }
                    }


                    // ارجع للصفحه 
                    header("Location: ./docPage.php");

                    exit();
                } else {
                    echo "You should select medications.";
                }
            }
            ?>
        </label>
    </div>

</body>

</html>