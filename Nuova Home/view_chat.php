<!DOCTYPE html>
<html lang="en">

<?php

require "connectionDB.php";
	
if(!isset($_SESSION['username'])) {
    header("location: login.php");
}

$user = $_SESSION['username'];

$other = $conn->real_escape_string($_GET['user_to']);
$_SESSION['PrevPage'] = "view_chat.php?user_to=".$other;

if(strcmp($user, $other) == 0){
    header("location: index.php");
}

$sql = "SELECT email FROM user WHERE Username = '".$other."' ";
$result = $conn->query($sql);
$check = $result->fetch_assoc();
if($result->num_rows == 0)
{	
	mysqli_free_result($result);
    header("location: index.php");
}

mysqli_free_result($result);


$sql = "UPDATE chat SET Is_read = 1 WHERE User_from = '".$other."' and User_to = '".$user."'";

if (!($conn->query($sql) === TRUE)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}


?>
<head>
    
    <?php
		require "head.php";
	?>
    <link rel="stylesheet" media="all" href="css/live_chat.css" />
    <script src="js/chat.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>

<?php
echo'
<section class="container min-height-login">
	<div class="chatView" id="logIn">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title"><h3 class="panel-title"><i class="fa fa-comment my-comment"></i> Chat with '.$other.'</h3></div>
			</div>
			
			
			<div id="message-panel-body" class="panel-body msg_container_base minHeightChat">';

			$sqlPic = "SELECT T.ProfilePic as MyPic, T2.ProfilePic as OtherPic FROM
						(SELECT ProfilePic FROM user WHERE username = '".$user."') as T,
						(SELECT ProfilePic FROM user WHERE username = '".$other."') as T2";
						
            $resultPic = mySQLi_query($conn, $sqlPic) or die("Error query Pic");
			$myPic = "";
			$otherPic = "";
            while($rowPic = mySQLi_fetch_array($resultPic)) {
				$myPic = "data:image/jpeg;base64,".base64_encode($rowPic['MyPic']);
				$otherPic = "data:image/jpeg;base64,".base64_encode($rowPic['OtherPic']);
			}
			
			mysqli_free_result($resultPic);	
			
            $sql = "SELECT distinct * FROM chat WHERE (User_from = '".$user."' and User_to = '".$other."') or (User_from = '".$other."' and User_to = '".$user."') ORDER BY Datetime ASC";

            $result = mySQLi_query($conn, $sql) or die("Error query");
            $list_users = array();

            while($row = mySQLi_fetch_array($result)) {
                if (strcmp($user, $row['User_from']) == 0) {
                    echo '
                        <div class="msg_container base_sent">
                            <div class="messageSent">
                                <div class="messages msg_sent">
                                    <p class="message-body">'.$row['Message'].'</p>
                                    <time>'.$row['Datetime'].'</time>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="'.$myPic.'" class="img-profile floatRight" alt="my profile img">
                            </div>
                        </div>';
                } else if (strcmp($user, $row['User_to']) == 0) {
                    echo '
                        <div class="msg_container base_receive">
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="'.$otherPic.'" class="img-profile" alt="other profile img">
                            </div>
                            <div class="messageReceived">
                                <div class="messages msg_receive">
                                    <p class="message-body">'.$row['Message'].'</p>
                                    <time>'.$row['Datetime'].'</time>
                                </div>
                            </div>
                        </div>';
                }
            }
			
			mysqli_free_result($result);

            echo'
            </div>
			<div class="panel-footer">
				<input type="hidden" id="user_to" value="'.$other.'">
				<textarea id="input-message" class="input-sm chat_input"></textarea>
				<span class="input-group-send">
				<button class="btn btn-primary btn-send" id="btn-chat" onclick="async_send_message()">Send <i class="fa fa-angle-right" style="color: black;"></i></button>
				</span>
			</div>			
		</div>
	</div>

</section>
';
?>


<?php
require "footer.php";

?>

</body>
</html>
