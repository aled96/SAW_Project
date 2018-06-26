<?php

require "../connectionDB.php";

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_to = '".$username."'";
    $result = mySQLi_query($conn, $sql) or die("Error query");
    $row = mySQLi_fetch_array($result);
    $unread_count = $row['count'];

    if($unread_count != 0)
        echo "<li><a href='chat.php'>Messages<i class='fa fa-exclamation-circle red-message' id='message-alert' name='message-alert'></i></a></li>";

}
mysqli_free_result($result);
$conn->close();
?>
