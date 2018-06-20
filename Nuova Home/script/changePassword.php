<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$new = $conn->real_escape_string($_POST['pswEncryptChange']);

$sql = "UPDATE user SET Password = '".$new."' WHERE Username = '".$user."'";

$result = mySQLi_query($conn, $sql) or die("Error query");

header("location: ../setting.php");

?>
