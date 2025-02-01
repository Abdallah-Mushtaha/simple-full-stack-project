<?php
include "./DB_Files/Connection_DB.php";
session_start();
$user_id = $_SESSION["user_Data"]["id"];
// echo "<h1>$user_id</h1>"; // للتجربه 

if (isset($_SESSION["user_Data"]) != true) {
    header("Location:./patientPage.php");
}


$query = "SELECT * from patients  where id='$user_id'";
$result = mysqli_query($con, $query);
if ($result === false) {
    echo "error ";
} else {
    echo "<tr>";

    while ($row = mysqli_fetch_assoc($result)) {

?>
        <h1>About Me</h1>
        <th scope="row">
        </th>
        <h3> ID :: <?php echo $row["id"] ?>
        </h3>
        <h3>name :: <?php echo  $row["name"] ?>
        </h3>
        <h3> email :: <?php echo $row["email"] ?>
        </h3>
        <h3>password :: <?php echo substr($row["password"], 0, 10) ?>
        </h3>
        <h3>Age :: <?php echo $row["age"] ?>
        </h3>
        <h3>Gender :: <?php echo $row["gender"] ?>
        </h3>
        <h3>Phone Number :: <?php echo $row["phoneNumber"] ?>

    <?php
        die();
    }
}
    ?>