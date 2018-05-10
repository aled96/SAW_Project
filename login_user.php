<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "university_sharing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['usernameLog'];
$pwd = $_POST['pswLog'];

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
    session_start();
    $_SESSION['username'] = $user;

    header("location: index.php");
}
else{
    echo "\n\nCredenziali non valide";
}

?>