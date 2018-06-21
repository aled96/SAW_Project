<?php

require "../connectionDB.php";

if(isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $other = $conn->real_escape_string($_GET['user_to']);

	$sqlPic = "SELECT ProfilePic FROM user WHERE username = '".$other."'";
						
	$resultPic = mySQLi_query($conn, $sqlPic) or die("Error query Pic");
	$otherPic = "";
	while($rowPic = mySQLi_fetch_array($resultPic)) {
		$otherPic = "data:image/jpeg;base64,".base64_encode($rowPic['ProfilePic']);
	}
	
	$sql = "SELECT distinct * FROM chat WHERE Is_read = 0 and User_from <> '".$other."' and User_to = '".$user."'";
    $result = mySQLi_query($conn, $sql) or die("Error query");
    $othermsg = $result->num_rows;
	
    $sql = "SELECT distinct * FROM chat WHERE Is_read = 0 and User_from = '".$other."' and User_to = '".$user."'";
    $result = mySQLi_query($conn, $sql) or die("Error query");
    $list_users = array();

    $returned_obj = "";

    while($row = mySQLi_fetch_array($result)) {
        $returned_obj = $returned_obj.'<div class="msg_container base_receive">
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="'.$otherPic.'" class="img-profile">
                            </div>
                            <div class="messageReceived">
                                <div class="messages msg_receive">
                                    <p class="message-body">' . $row['Message'] . '</p>
                                    <time>' . $row['Datetime'] . '</time>
                                </div>
                            </div>
                        </div>';
    }

    $sql = "UPDATE chat SET Is_read = 1 WHERE User_from = '".$other."' and User_to = '".$user."'";

    if (!($conn->query($sql) === TRUE)) {
        die("Error: " . $sql . "<br>" . $conn->error);
    }

    if($othermsg > 0)
    {
        $returned_obj = $returned_obj."§§§new";
    }
    
    echo $returned_obj;

}
$conn->close();

?>
