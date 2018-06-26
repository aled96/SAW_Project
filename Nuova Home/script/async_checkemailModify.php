<?php

require "../connectionDB.php";

$email = $conn->real_escape_string(trim($_GET['email']));

if(!isset($_SESSION['username'])) {
    die("Error");
}
$username = $_SESSION['username'];

$sql = "SELECT email FROM user where email ='$email' AND Username !='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "email";
}
else
	echo "ok";

$conn->close();
?>
