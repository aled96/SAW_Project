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

$author = $_POST['author'];
$title = $_POST['title'];
$description = $_POST['description'];
$pages = $_POST['pages'];
$ed = $_POST['edition'];
$isbn = $_POST['isbn'];
$cover = $_POST['image'];

session_start();
$user = $_SESSION['username'];

#Insert Book Information
$sql = "INSERT INTO `university_sharing`.`book` (`ID`, `Author`, `Title`, `Description`, `PageNum`, `Edition`, `ISBN`) VALUES (NULL, '$author', '$title', '$description', '$pages', '$ed', '$isbn');";


if (mysqli_query($conn, $sql)) {
    $id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $id;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

#Insert in Concern TODO !!!!!!!
$sql2 = "INSERT INTO concern (Book, Category)
VALUES ('$id', '1')";

if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql2 . "<br>" . $conn->error);
}

#Insert in Insertion TODO!!!!
$sql3 = "INSERT INTO `university_sharing`.`insertion` (`ID`, `User_offerer`, `Material_offered`, `Date_of_pubblication`, `Place`, `Price`, `Description`) VALUES (NULL, '$user', '$id', '', '12', '1', '1');";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql3 . "<br>" . $conn->error);
}

header("location: PageBook.php?Id=".$id."");

?>