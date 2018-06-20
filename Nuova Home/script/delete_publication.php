<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$id = $conn->real_escape_string($_GET['id']);
//Delete from DB (just in Book -> cascade, it will be deleted from the other tables
$sql = "DELETE FROM book WHERE ID = '".$id."'";

$result = mySQLi_query($conn, $sql) or die("Error query");

header("location: ../my_publications.php?page=1");
?>
