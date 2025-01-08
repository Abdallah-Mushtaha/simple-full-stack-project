<?php
$con = new mysqli("localhost", "root", "", "hospital");
if ($con === false) {
    echo "Error :: " . mysqli_connect_error();
}
