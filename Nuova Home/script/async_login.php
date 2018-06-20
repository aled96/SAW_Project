<?php

require "../connectionDB.php";

$user = $conn->real_escape_string($_GET['username']);
$pwd = $conn->real_escape_string($_GET['password']);

$login = false;

$sql = "SELECT username, password FROM user where username ='".$user."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["password"] == $pwd)
        {
            $login = true;
        }
    }
}

$conn->close();

if($login){
    echo "ok";
}
else{
    echo "non ok";
}

?>
