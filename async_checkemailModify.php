<?php
require "db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];
$username = $_GET['username'];

$sql = "SELECT email FROM user where email ='$email' AND Username !='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "email";
}
else
	echo "ok";

$conn->close();
?>