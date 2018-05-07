<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university_sharing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();
#TODO -> Check empty --> save blank
$user = $_SESSION['username'];
$email = $_POST['emailSign'];
$pwd = $_POST['pswSign'];
$name = $_POST['nameSign'];
$surname = $_POST['surnameSign'];
$gender = $_POST['gender'];
$date_birth = $_POST['dateSign'];

$sql = "UPDATE `university_sharing`.`user` SET `email` = '$email', `name` = '$name', `surname` = '$surname',`gender` = '$gender',`date_of_birth` = '$date_of_birth' WHERE `username` = '$user'";

$result = mySQLi_query($conn, $sql) or die("Error query");

header("location: index.php");

?>