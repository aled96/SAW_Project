<?php

require "../connectionDB.php";

$email = $_GET['email'];
$username = $_GET['username'];

$login = false;

$sql = "SELECT email FROM user where email ='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "email";
}
else{
    $sql = "SELECT username FROM user where username ='".$username."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "username";
    }
    else
        echo "ok";
}

$conn->close();
?>
