
<?php

require "mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "DELETE FROM province WHERE 1";
if ($conn->query($sql) === TRUE) {
    echo "Database deleted successfully";
} else {
    echo "Error deleting database: " . $conn->error;
}

$conn->close();

// Create new connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$handle = fopen("province.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $contents = explode(",", $line);
        $prov = mysqli_real_escape_string($conn, trim($contents[1]));
        $reg = mysqli_real_escape_string($conn, trim($contents[0]));
        $sql = "INSERT INTO province (ID, Name, Region) VALUES (NULL, '".$prov."', '".$reg."');";
        if (mysqli_query($conn, $sql)) {
            ;
        } else {
            echo "<br>".$sql."<br>";
            echo "Error: ". mysqli_error($conn);
        }
    }

    fclose($handle);
} else {
    echo "Error: opening file";
}


$conn->close();
?>
