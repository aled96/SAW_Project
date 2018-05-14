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

$province = $_GET['province'];

$sql = "SELECT distinct Id FROM province where name = '".$province."'";
$result = $conn->query($sql);

$id = 0;

while($row = $result->fetch_assoc()) {
    $id = $row['Id'];
}


$sql = "SELECT distinct name FROM city where province = '".$id."'";
$result = $conn->query($sql);

$cities_to_return = "<option value='not-selected' selected disabled>City</option>";

while($row = $result->fetch_assoc()) {
    $city = $row['name'];
    if(strlen($city) != 0) {
    $cities_to_return = $cities_to_return."<option value='" . $city . "'>" . $city . "</option>";
    }
}

echo $cities_to_return;


$conn->close();

?>