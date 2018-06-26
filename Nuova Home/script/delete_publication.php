<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$id = $conn->real_escape_string(trim($_POST['id']));

$sql = "SELECT User_offerer FROM insertion WHERE Material_offered = '".$id."';";
$result = $conn->query($sql);
$check = $result->fetch_assoc();
if($result->num_rows == 0)
{
    header("location: index.php");
}
else if(strcmp($check['User_offerer'], $_SESSION['username']) != 0){
    header("location: index.php");
}
mysqli_free_result($result);
//Delete from DB (just in Book -> cascade, it will be deleted from the other tables
$sql = "DELETE FROM book WHERE ID = '".$id."'";

$result = mySQLi_query($conn, $sql) or die("Error query");

$conn->close();

header("location: ../show_profile.php?user=".$_SESSION['username']."&page=1");
?>
