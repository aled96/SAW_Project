<?php

require "mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "DELETE FROM city WHERE 1";
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

$handle = fopen("comuni.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $contents = explode(",", $line);
        $comune = mysqli_real_escape_string($conn, trim($contents[0]));
        $provincia = "";
        if(strcmp(mysqli_real_escape_string($conn, trim($contents[1])), "-") == 0)
            $provincia = mysqli_real_escape_string($conn, trim($contents[2]));
        else
            $provincia = mysqli_real_escape_string($conn, trim($contents[1]));

        $stmt = $conn->prepare("SELECT distinct ID FROM province where Name = ?");
        $stmt->bind_param("s", $provincia);

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($ids);
        while($stmt->fetch()) {
            $id = $ids;
        }

        $stmt->close();

        $sql = "INSERT INTO city (ID, Name, Province) VALUES (NULL, '".$comune."', '".$id."');";

        if (mysqli_query($conn, $sql)) {
            ;
        } else {
            echo "Error: ". mysqli_error($conn);
            echo "<br>".$sql."<br>".$provincia." con id ".$id;
        }

    }

    fclose($handle);
} else {
    echo "Error: opening file";
}


$conn->close();
?>
