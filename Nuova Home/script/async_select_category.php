<?php

require "../connectionDB.php";

$faculty = $conn->real_escape_string(trim($_GET['faculty']));

$sql = "SELECT distinct ID FROM faculty where name = '".$faculty."'";
$result = $conn->query($sql);

$id = 0;

while($row = $result->fetch_assoc()) {
    $id = $row['ID'];
}


$sql = "SELECT distinct name FROM category where Faculty = '".$id."'";
$result = $conn->query($sql);

$categories_to_return = "<option value='not-selected' selected disabled>Category</option>";

while($row = $result->fetch_assoc()) {
    $cat = $row['name'];
    if(strlen($cat) != 0) {
    $categories_to_return = $categories_to_return."<option value='" . $cat . "'>" . $cat . "</option>";
    }
}
mysqli_free_result($result);

$conn->close();

echo $categories_to_return;

?>
