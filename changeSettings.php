<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "university_sharing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();
$user = $_SESSION['username'];
$email = $_POST['emailSign'];
$pwd = $_POST['pswSign'];
$name = $_POST['nameSign'];
$surname = $_POST['surnameSign'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['dateSign'];

$sql = "UPDATE user SET Email = '".$email."', Name = '".$name."', Surname = '".$surname."',Gender = '".$gender."',Date_of_birth = '".$date_of_birth."' WHERE Username = '".$user."'";

echo $sql;

$result = mySQLi_query($conn, $sql) or die("Error query");

header("location: index.php");

?>