<?php
session_start();
$user_id = $_SESSION["user_Data"]["id"];
// echo "<h1>$user_id</h1>"; // للتجربه 
if (isset($_SESSION["user_Data"]) != true) {
    header("Location:./login.php");
}


include "./DB_Files/Connection_DB.php";

$query = "SELECT pd.drug_id, d.name AS drug_name, d.dosage, d.productionDate, d.expiryDate
FROM patientdrug pd
INNER JOIN drugs d ON pd.drug_id = d.id
WHERE pd.pat_id = $user_id
";
$result = mysqli_query($con, $query);
if ($result === false) {
    echo "Error: " . mysqli_error($con);
} else {

    while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <th scope="row">◾</th>
            <td><?php echo $row["drug_id"] ?></td>
            <td><?php echo $row["drug_name"] ?></td>
            <td><?php echo $row["dosage"] ?></td>
            <td><?php echo $row["productionDate"] ?></td>
            <td><?php echo $row["expiryDate"] ?></td>
        </tr>
<?php
    }


    die();
}
?>