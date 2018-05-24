<?php

require "db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_to = '".$username."'";
    $result = mySQLi_query($conn, $sql) or die("Error query");
    $row = mySQLi_fetch_array($result);
    $unread_count = $row['count'];

    if($unread_count == 0)
        echo "<a href='chat.php'><i class='icon-envelope icon-white'></i> Messagges </a>";
    else
        echo "<a href='chat.php'><i class='icon-envelope icon-white'></i> Messagges <i class='fa fa-exclamation' style='color: red;'></i> (".$unread_count.")</a>";

}

$conn->close();


?>