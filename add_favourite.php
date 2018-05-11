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
echo "Connected successfully";

$book = $_GET['Book'];

session_start();
$user = $_SESSION['username'];

#Check if already Exists
$sql = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='$book' and Username='$user';";

$result = mySQLi_query($conn, $sql) or die("Error query");
		
while($row = mySQLi_fetch_array($result)){
	#If there is not ---> Add !
	if($row['IsThere'] == 0){
		$sql = "INSERT INTO `university_sharing`.`wishlist` (`Username`, `Book`) VALUES ('$user', '$book');";


		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully.";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	else{ #Otherwise -> delete it from the list
		$sql = "DELETE FROM `university_sharing`.`wishlist` WHERE Book='$book' and Username='$user';";

		if (mysqli_query($conn, $sql)) {
			echo "Record deleted successfully.";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}	
	}
}
header("location: PageBook.php?Id=".$book."");

?>