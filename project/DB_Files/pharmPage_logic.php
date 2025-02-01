<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];
include "./DB_Files/Connection_DB.php";


/* سيناريو الحذف رح يصلك  الاي دي اول ما يعمل حذف من خلاله رح اجيب ال ايميل واحذف البيات من الجدول المرضى باستخدام ال اي دي وجدول المستخدمين من خلال الايميل رح احذف  

*/

if (isset($_GET["delet"]) && !empty($_GET["id"])) {
    $drugID = intval($_GET["id"]); //حول لرقم عشان اتعامل معاه صح 
    $deleteQuery = "DELETE  FROM drugs WHERE id = '$drugID'";

    $deleteResult = mysqli_query($con, $deleteQuery);
    if ($deleteResult) {
        header("Location:pharmPage.php");
    }
}


// نهايه كود الحذف 
//************************************************************************************** */



//  استرجاع مع نقل عند الضغط على تعديل 

$query = "SELECT * from drugs where pharmacists_id='$user_id'";
$result = mysqli_query($con, $query);
if ($result === false) {
    echo "error ";
} else {
    echo "<tr>";

    while ($row = mysqli_fetch_assoc($result)) {

?>
        <div class="row   align-items-center justify-content-center">
            <div class="col-md-10 ">
                <div class="wrapper ">
                    <div class="box">
                        <div class="title">
                            <small id="id"><?php echo  "#", $row["id"], " :: " ?></small>
                            <small id="name"><?php echo  $row["name"] ?></small>
                        </div>

                        <div class="wrapper-info">
                            <div id="dosage"><?php echo "<span>dosage :: </span> ", $row["dosage"] ?></div>
                            <div id="productionDate"><?php echo "<span>productionDate :: </span>",  substr($row["productionDate"], 0, 10)  ?></div>
                            <div id="expiryDate"><?php echo "<span>expiryDate :: </span>",  $row["expiryDate"] ?></div>
                            <div id="pharmacists_id"><?php echo  "<span>pharmacists_id :: </span> ", $row["pharmacists_id"] ?></div>

                        </div>
                        <div class="btn-wrapper d-flex  justify-content-center align-items-center gap-2">
                            <div class="wrrapicon">

                                <form action="" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                    <input type="submit" name="delet" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure you want to delete this patient?');">
                                </form>


                                <!--   زر التعديل
            pationt form Logic   رح ابعت البيانات ال لازمه  لصفحه ورح يصير السيناريو ال ذكرتو بصفحة ال -->
                                <form action="./Druges.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>">
                                    <input type="hidden" name="dosage" value="<?php echo htmlspecialchars($row["dosage"]); ?>">
                                    <input type="hidden" name="productionDate" value="<?php echo htmlspecialchars($row["productionDate"]); ?>">

                                    <input type="hidden" name="expiryDate" value="<?php echo htmlspecialchars($row["expiryDate"]); ?>">


                                    <input type="submit" name="Edite" class="btn btn-primary" value="Edit">

                                </form>

                            </div>
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