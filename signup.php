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

$nick = $_POST['nickSign'];
$email = $_POST['emailSign'];
$pwd = $_POST['pswSign'];
$name = $_POST['nameSign'];
$surname = $_POST['surnameSign'];
$genre = $_POST['genre'];
$date_birth = $_POST['dateSign'];

$sql = "INSERT INTO User (username, email, password, name, surname, genre, date_of_birth, city)
VALUES ('$nick', '$email', '$pwd', '$name', '$surname', '$genre', '$date_birth', null)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

session_start();
$_SESSION['username'] = $nick;

header("location: /index.php");

?>