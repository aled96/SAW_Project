<?php

require "../db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$author = $_POST['author'];
$title = $_POST['title'];
$description = $_POST['description'];
$pages = $_POST['pages'];
$ed = $_POST['edition'];
$isbn = $_POST['isbn'];

//Get the content of the image and then add slashes to it
$imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$n_categories = $_POST['number_of_categories'];

$date_of_pubblication = date('Y/m/d', time());

$place = $_POST['place'];
$price = $_POST['price'];

session_start();
if(!isset($_SESSION['username'])) {
    header("location: index.php");
}
$user = $_SESSION['username'];


#Insert Book Information
$sql = "INSERT INTO book (ID, Author, Title, Description, PageNum, Edition, ISBN, Cover) VALUES (NULL, '".$author."', '".$title."', '".$description."', '".$pages."', '".$ed."', '".$isbn."', '".$imgData."');";

$id = 0;

if (mysqli_query($conn, $sql)) {
    $id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $id;
} else {
    echo "Error: ". mysqli_error($conn);
}

#Insert in Concern
for($i = 1; $i <= $n_categories; $i++)
{
    $CatPostName = "cat".$i;
    if(isset($_POST[$CatPostName])) {
        $category = $_POST[$CatPostName];
        $sql = "SELECT distinct ID FROM category where name = '" . $category . "'";
        $result_cat = $conn->query($sql);

        $id_cat = 0;

        while ($row_cat = $result_cat->fetch_assoc()) {
            $id_cat = $row_cat['ID'];
        }
        $sql2 = "INSERT INTO concern (Book, Category)
      VALUES ('" . $id . "', '" . $id_cat . "')";

        if ($conn->query($sql2) === TRUE) {
            echo "New record created successfully";
        } else {
            die("Error: " . $sql2 . "<br>" . $conn->error);
        }
    }
}

#Insert in Insertion
$sql3 = "INSERT INTO insertion (ID, User_offerer, Material_offered, Date_of_pubblication, Place, Price) VALUES (NULL, '".$user."', '".$id."', '".$date_of_pubblication."', '".$place."', '".$price."');";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
} else {
    die("Error: " . $sql3 . "<br>" . $conn->error);
}

header("location: ../PageBook.php?Id=".$id."");

?>
