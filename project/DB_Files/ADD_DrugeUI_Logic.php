<?php


/*
this page for test only not important page
ملاحظة هذه صفحة تجارب ليس الا   
ليست مهمه 

*/



include "./DB_Files/Connection_DB.php";

if (isset($_SESSION["Patient_id"])) {

    echo $_SESSION["Patient_id"];
}



$query = "SELECT * FROM drugs";
$result = mysqli_query($con, $query);
if ($result === false) {
    echo "Error: " . mysqli_error($con);
} else {
?>
    <form action="" method="get">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <label class="sel">
                <input type="checkbox" name="medications[]" value="<?php echo htmlspecialchars($row["id"]); ?>">
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

// معالجة البيانات عند الإرسال
if (isset($_GET["Save"])) {
    if (!empty($_GET["medications"])) {
        // echo "Selected medications:<br>";
        // foreach ($_GET["medications"] as $medications) {
        //     $drug_id = htmlspecialchars($medications);
        //     $Addition_query = "INSERT INTO patientdrug(pat_id,drug_id)values( $Patient_id,$drug_id)";
        // }

        // $Addition_Result = mysqli_query($con, $Addition_query);




        print_r($_GET);

        // header("Location:./docPage.php");

    } else {
        echo "You should  selected medications .";
    }
}


?>