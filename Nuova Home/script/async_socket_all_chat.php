<?php

require "../connectionDB.php";

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT distinct User_from, COUNT(*) as count FROM chat WHERE Is_read = 0 and User_to = '".$username."' GROUP BY User_from";

    $result = mySQLi_query($conn, $sql) or die("Error query");
    $list_users = array();

    while($row = mySQLi_fetch_array($result)){
        echo $row['User_from']." ".$row['count'].",";
    }

    $sql = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_to = '".$username."'";
    $result = mySQLi_query($conn, $sql) or die("Error query");
    $row = mySQLi_fetch_array($result);
    $unread_count = $row['count'];
    echo $row['count'];
}
mysqli_free_result($result);
$conn->close();

?>
