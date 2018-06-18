<!DOCTYPE html>
<html lang="en">

<?php

require "db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
if(!isset($_SESSION['username'])) {
    header("location: login.php");
}

$user = $_SESSION['username'];
$other = $conn->real_escape_string($_GET['user_to']);

$_SESSION['PrevPage'] = "view_chat.php?user_to=".$other;

if(strcmp($user, $other) == 0){
    header("location: index.php");
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    header("location: login.php");
}

$sql = "UPDATE chat SET Is_read = 1 WHERE User_from = '".$other."' and User_to = '".$user."'";

if (!($conn->query($sql) === TRUE)) {
    die("Error: " . $sql . "<br>" . $conn->error);
    header("location: login.php");
}

?>
<head>
    <title>BookTrader</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NewHomeTest.css">

    <link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" media="all" href="css/chat.css" />
    <link rel="stylesheet" media="all" href="css/live_chat.css" />
    <script src="js/common.js"></script>
    <script src="js/chat.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>
<div class="chat-window col-xs-11 col-md-10 col-lg-10" id="chat_window_1">
    <div class="col-xs-12 col-md-12">
        <?php
            echo'
                <div class="panel panel-default">
                    <div class="panel-heading top-bar">
                            <h3 class="panel-title"><i class="fa fa-comment my-comment"></i><chat_with> Chat with</chat_with> '.$other.'</h3>
                    </div>
                    <div id="message-panel-body" class="panel-body msg_container_base">';

            $sql = "SELECT distinct * FROM chat WHERE (User_from = '".$user."' and User_to = '".$other."') or (User_from = '".$other."' and User_to = '".$user."')";

            $result = mySQLi_query($conn, $sql) or die("Error query");
            $list_users = array();

            while($row = mySQLi_fetch_array($result)) {
                if (strcmp($user, $row['User_from']) == 0) {
                    echo '
                        <div class="msg_container base_sent">
                            <div class="col-md-10 col-sm-11 col-xs-11">
                                <div class="messages msg_sent">
                                    <p class="message-body">'.$row['Message'].'</p>
                                    <time>'.$row['Datetime'].'</time>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="img-profile img-responsive ">
                            </div>
                        </div>';
                } else if (strcmp($user, $row['User_to']) == 0) {
                    echo '
                        <div class="msg_container base_receive">
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="img-profile img-responsive ">
                            </div>
                            <div class="col-md-10 col-sm-11 col-xs-11">
                                <div class="messages msg_receive">
                                    <p class="message-body">'.$row['Message'].'</p>
                                    <time>'.$row['Datetime'].'</time>
                                </div>
                            </div>
                        </div>';
                }
            }

            echo'
            </div>
                <div class="panel-footer">
                    <input type="hidden" id="user_to" value="'.$other.'">
                    <textarea id="input-message" class="input-sm chat_input"></textarea>
                    <span class="input-group-send">
                    <button class="btn btn-primary btn-send" id="btn-chat" onclick="async_send_message()">Send <i class="fa fa-angle-right" style="color: black;"></i></button>
                    </span>
                </div>
            </div>';
        ?>
    </div>
</div>

<?php
require "footer.php";

?>

</body>
</html>