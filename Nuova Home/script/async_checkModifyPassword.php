<?php

require "../connectionDB.php";

$old_pass = $conn->real_escape_string($_GET['old']);

if(!isset($_SESSION['username'])) {
    die("Error");
}
$user = $_SESSION['username'];

$sql = "SELECT Password FROM user where Password ='$old_pass' AND Username ='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "ok";
}
else
	echo $sql;
	
mysqli_free_result($result);

$conn->close();

?>
