<?php

require "../connectionDB.php";

$book = $conn->real_escape_string($_GET['Book']);


if(!isset($_SESSION['username'])) {
    header("location: index.php");
}
$user = $_SESSION['username'];

#Check if already Exists
$sql = "SELECT COUNT(*) as IsThere FROM wishlist WHERE Book='$book' and Username='$user';";

$result = mySQLi_query($conn, $sql) or die("Error query");
		
while($row = mySQLi_fetch_array($result)){
	#If there is not ---> Add !
	if($row['IsThere'] == 0){
		$sql = "INSERT INTO wishlist (Username, Book) VALUES ('$user', '$book');";


		if (mysqli_query($conn, $sql)) {
			echo $book.";<i onClick='preferite(".$book.")' class='fa fa-heart'></i>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	else{ #Otherwise -> delete it from the list
		$sql = "DELETE FROM wishlist WHERE Book='$book' and Username='$user';";

		if (mysqli_query($conn, $sql)) {
			echo $book.";<i onClick='preferite(".$book.")' class='fa fa-heart-o'></i>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}	
	}
}

?>
