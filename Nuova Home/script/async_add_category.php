<?php
require "../db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$count = $_GET['count'];

$facName = "fac".$count;

$returned_obj = "<select name='".$facName."' id='".$facName."' class='form-control marginTop-40' required onchange='selectCategory(".$count.")'>
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
                    <select name='".$catName."' class='form-control marginTop-20' required  id='".$catName."' >
                        <option value='not-selected' selected disabled>Category</option>
                    </select>";

$returned_obj = $returned_obj."
<div>
<button type='button' class='btn btn-success cat-btn' id='removeButton".$count."' onclick='removeCategory(".$count.")'>Remove Category</button>
</div>";

echo $returned_obj;

?>
