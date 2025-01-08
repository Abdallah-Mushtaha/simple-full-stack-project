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
        <th scope="row"><?php echo "◾" ?></th>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo  $row["name"] ?></td>
        <td><?php echo  $row["dosage"] ?></td>
        <td><?php echo $row["productionDate"] ?></td>
        <td><?php echo  $row["expiryDate"] ?></td>
        <td><?php echo  $row["pharmacists_id"] ?></td>

        <td>
            <div class="wrrapicon">

                <form action="" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                    <input type="submit" name="delet" value="Delete" onclick="return confirm('Are you sure you want to delete this patient?');">
                </form>


                <!--   زر التعديل
            pationt form Logic   رح ابعت البيانات ال لازمه  لصفحه ورح يصير السيناريو ال ذكرتو بصفحة ال -->
                <form action="./Druges.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($row["name"]); ?>">
                    <input type="hidden" name="dosage" value="<?php echo htmlspecialchars($row["dosage"]); ?>">
                    <input type="hidden" name="productionDate" value="<?php echo htmlspecialchars($row["productionDate"]); ?>">

                    <input type="hidden" name="expiryDate" value="<?php echo htmlspecialchars($row["expiryDate"]); ?>">


                    <input type="submit" name="Edite" value="Edit">

                </form>



            </div>
        </td>


        </tr>
<?php
    }
    die();
}
?>