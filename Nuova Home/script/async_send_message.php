<?php

require "../connectionDB.php";


if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
	
	$sqlPic = "SELECT ProfilePic FROM user WHERE username = '".$username."'";
						
	$resultPic = mySQLi_query($conn, $sqlPic) or die("Error query Pic");
	$myPic = "";
	while($rowPic = mySQLi_fetch_array($resultPic)) {
		$myPic = "data:image/jpeg;base64,".base64_encode($rowPic['ProfilePic']);
	}
	
    $other = $conn->real_escape_string($_GET['user_to']);
    $message = $conn->real_escape_string($_GET['message']);
    $datetime = date('m/d/Y h:i:s a', time());

    $returned_obj = '<div class="msg_container base_sent">
                                <div class="messageSent">
                                    <div class="messages msg_sent">
                                        <p class="message-body">'.$_GET['message'].'</p>
                                        <time>'.$datetime.'</time>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 avatar">
                                    <img src="'.$myPic.'" class="img-profile floatRight">
                                </div>
                            </div>';


    $sql = "INSERT INTO chat (User_from, User_to, Message, Datetime) VALUES ('".$username."', '".$other."', '".$message."', CURRENT_TIMESTAMP);";

    if ($conn->query($sql) === TRUE) {
        echo $returned_obj;
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
    }
}
$conn->close();
?>