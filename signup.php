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

$user = $_POST['userSign'];
$email = $_POST['emailSign'];
$pwd = $_POST['pswSign'];
$name = $_POST['nameSign'];
$surname = $_POST['surnameSign'];
$gender = $_POST['gender'];
$date_birth = $_POST['dateSign'];
$city = $_POST['citySign'];

$sql = "INSERT INTO user (username, email, password, name, surname, gender, date_of_birth, city)
VALUES ('$user', '$email', '$pwd', '$name', '$surname', '$gender', '$date_birth', '$city')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

session_start();
$_SESSION['username'] = $user;

header("location: index.php");

?>