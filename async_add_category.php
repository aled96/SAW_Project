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

$count = $_GET['count'];

$facName = "fac".$count;

$returned_obj = "<select name='".$facName."' id='".$facName."' class='feedback-input' required onchange='selectCategory(".$count.")'>
                        <option value='not-selected' selected disabled>Faculty</option>";


$sql = "SELECT distinct Name FROM faculty";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $fac = $row['Name'];
    if(strlen($fac) != 0) {
        $returned_obj = $returned_obj."<option value='" . $fac . "'>" . $fac . "</option>";
    }
}

$conn->close();

$catName = "cat".$count;

$returned_obj = $returned_obj."</select>
                    <select name='".$catName."' class='feedback-input' required  id='".$catName."' >
                        <option value='not-selected' selected disabled>Category</option>
                    </select>";

echo $returned_obj;

?>