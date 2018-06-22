<?php

require "../connectionDB.php";

$user = $conn->real_escape_string($_POST['usernameLog']);
$pwd = $conn->real_escape_string($_POST['pswEncryptLog']);

$user = strtolower($user);
$login = false;

$sql = "SELECT Username, Password FROM user where Username ='".$user."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["Password"];
        if($row["Password"] == $pwd)
        {
            $login = true;
        }
    }
}
else
    echo $sql;

$conn->close();

if($login){
    $_SESSION['username'] = $user;
	
	if(isset($_SESSION['PrevPage']))
		header("location: ../".$_SESSION['PrevPage']);
	else
		header("location: ../index.php");
}
else{
    header("location: ../index.php");
}

?>
