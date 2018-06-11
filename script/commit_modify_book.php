<?php

require "../db/mysql_credentials.php";

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
$id = $_POST['id'];
$author = $_POST['author'];
$title = $_POST['title'];
$description = $_POST['description'];
$pages = $_POST['pages'];
$edition = $_POST['edition'];
$isbn = $_POST['isbn'];
$img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$price = $_POST['price'];
$place = $_POST['place'];

if($img == null)
	$sql = "UPDATE book SET Author = '".$author."', Title = '".$title."', Description = '".$description."',PageNum = '".$pages."',Edition = '".$edition."', ISBN = '".$isbn."' WHERE ID = '".$id."'";
else
	$sql = "UPDATE book SET Author = '".$author."', Title = '".$title."', Description = '".$description."',PageNum = '".$pages."',Edition = '".$edition."', ISBN = '".$isbn."', Cover = '".$img."' WHERE ID = '".$id."'";

$result = mySQLi_query($conn, $sql) or die("Error query");

$sql2 = "UPDATE insertion SET Place = '".$place."', Price = '".$price."' WHERE Material_offered = '".$id."'";

$result2 = mySQLi_query($conn, $sql2) or die("Error query2");
header("location: ../PageBook.php?Id=".$id);

?>
