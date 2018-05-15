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
$pwd = $_POST['pswEncryptSign'];
$name = $_POST['nameSign'];
$surname = $_POST['surnameSign'];
$gender = $_POST['gender'];
$date_birth = $_POST['dateSign'];
$city = $_POST['citySign'];

$sql2 = "SELECT ID from city where NAME = '".$city."'";

$result2 = mySQLi_query($conn, $sql2) or die("Error query2");

while($row2 = mySQLi_fetch_array($result2)){
    $city = $row2['ID'];
}

$sql = "INSERT INTO user (Username, Email, Password, Name, Surname, Gender, Date_of_birth, City)
VALUES ('$user', '$email', '$pwd', '$name', '$surname', '$gender', '$date_birth', '$city')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

session_start();
$_SESSION['username'] = $user;

if(isset($_SESSION['PrevPage']))
	header("location: ".$_SESSION['PrevPage']);
else
	header("location: index.php");

?>