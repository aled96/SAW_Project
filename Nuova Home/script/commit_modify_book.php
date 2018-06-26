<?php

require "../connectionDB.php";

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$id = $conn->real_escape_string(trim($_POST['id']));
$author = $conn->real_escape_string(trim($_POST['author']));
$title = $conn->real_escape_string(trim($_POST['title']));
$description = $conn->real_escape_string(trim(nl2br($_POST['description'])));
$pages = $conn->real_escape_string(trim($_POST['pages']));
$edition = $conn->real_escape_string(trim($_POST['edition']));
$isbn = $conn->real_escape_string(trim($_POST['isbn']));
$price = $conn->real_escape_string(trim($_POST['price']));
$place = $conn->real_escape_string(trim($_POST['place']));

if ($_FILES['image']['size'] == 0){
    $img = null;
}
else{
	$img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}

$sql = "SELECT User_offerer FROM insertion WHERE Material_offered = '".$id."';";
$result = $conn->query($sql);
$check = $result->fetch_assoc();
if($result->num_rows == 0)
{
    header("location: index.php");
}
else if(strcmp($check['User_offerer'], $_SESSION['username']) != 0){
    header("location: index.php");
}

$n_categories = $conn->real_escape_string(trim($_POST['number_of_categories']));

if($img == null)
	$sql = "UPDATE book SET Author = '".$author."', Title = '".$title."', Description = '".$description."',PageNum = '".$pages."',Edition = '".$edition."', ISBN = '".$isbn."' WHERE ID = '".$id."'";
else
	$sql = "UPDATE book SET Author = '".$author."', Title = '".$title."', Description = '".$description."',PageNum = '".$pages."',Edition = '".$edition."', ISBN = '".$isbn."', Cover = '".$img."' WHERE ID = '".$id."'";

	
$result = mySQLi_query($conn, $sql) or die("Error query");

// See old categories
$sql2 = "SELECT Category FROM concern WHERE Book = ".$id.";";
$result_cat2 = $conn->query($sql2);
	
#Insert in Concern
for($i = 1; $i <= $n_categories; $i++)
{
	$CatPostName = "cat".$i;
	if(isset($_POST[$CatPostName])) {
		$category = trim($_POST[$CatPostName]);
		$sql3 = "SELECT distinct ID FROM category where name = '" . $category . "'";
		$result_cat3 = $conn->query($sql3);

		$id_cat = 0;

		while ($row_cat3 = $result_cat3->fetch_assoc()) {
			$id_cat = $row_cat3['ID'];
		}
		
		$alreadyInserted = false;
		
		while ($row_cat2 = $result_cat2->fetch_assoc()) {
			$id_cat_old = $row_cat2['Category'];
			if($id_cat == $id_cat_old)
				$alreadyInserted = true;
		}
		
		if($alreadyInserted == false)
		{
			$sql4 = "INSERT INTO concern (Book, Category) VALUES ('" . $id . "', '" . $id_cat . "')";

			if ($conn->query($sql4) === TRUE) {
				echo "New record created successfully";
			} else {
				die("Error4: " . $sql4 . "<br>" . $conn->error);
			}
		}
		
		
	}
}	

$sql5 = "UPDATE insertion SET Place = '".$place."', Price = '".$price."' WHERE Material_offered = '".$id."'";

$result5 = mySQLi_query($conn, $sql5) or die("Error query5");

$conn->close();

header("location: ../pageBook.php?Id=".$id);

?>
