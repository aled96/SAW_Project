<?php

require "db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();
if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$email = $_POST['emailChange'];
$name = $_POST['nameChange'];
$surname = $_POST['surnameChange'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['dateChange'];
$city = $_POST['cityChange'];

//TODO -> Aggiungere parte di immagine -> se vuota, non aggiornare !
//TODO -> NON VAAAA
$imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));

$sql = "UPDATE user SET Email = '".$email."', Name = '".$name."', Surname = '".$surname."',Gender = '".$gender."',Date_of_birth = '".$date_of_birth."', City = '".$city."' WHERE Username = '".$user."'";

$result = mySQLi_query($conn, $sql) or die("Error query");
//TODO -> aggiungere reindirizzamento a pagina precedente (??)
header("location: index.php");

?>