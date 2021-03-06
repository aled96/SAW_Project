<?php

require "../db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $other = $conn->real_escape_string($_GET['user_to']);
    $message = $conn->real_escape_string($_GET['message']);
    $datetime = date('d/m/Y h:i:s', time());

    $returned_obj = '<div class="msg_container base_sent">
                                <div class="col-md-10 col-sm-11 col-xs-11">
                                    <div class="messages msg_sent">
                                        <p class="message-body">'.$message.'</p>
                                        <time>'.$datetime.'</time>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 avatar">
                                    <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="img-profile img-responsive ">
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
