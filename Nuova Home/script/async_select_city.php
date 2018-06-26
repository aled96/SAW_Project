<?php

require "../connectionDB.php";

$id = $conn->real_escape_string(trim($_GET['province']));

$sql = "SELECT distinct Name,ID FROM city where Province = '".$id."'";
$result = $conn->query($sql);

$cities_to_return = "<option value='not-selected' selected disabled>City</option>";

while($row = $result->fetch_assoc()) {
    $city = $row['Name'];
    $cityId = $row['ID'];
    if(strlen($city) != 0) {
        $cities_to_return = $cities_to_return."<option value='" . $cityId. "'>" . $city . "</option>";
    }
}

echo $cities_to_return;


$conn->close();

?>
