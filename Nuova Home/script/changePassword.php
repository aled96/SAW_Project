<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$new = $conn->real_escape_string($_POST['pswEncryptChange']);
$old = $conn->real_escape_string($_POST['pswEncryptOldChange']);


$sql = "SELECT Password FROM user where Password ='$old' AND Username ='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$sql2 = "UPDATE user SET Password = '".$new."' WHERE Username = '".$user."'";

	$result2 = mySQLi_query($conn, $sql2) or die("Error query");
}
mysqli_free_result($result);

$conn->close();

header("location: ../setting.php");

?>
