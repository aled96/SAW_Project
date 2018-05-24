<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$other = $_GET['user_to'];
$_SESSION['PrevPage'] = "view_chat.php?user_to=".$other;

if(!isset($_SESSION['username'])) {
    header("location: login.php");
}

$user = $_SESSION['username'];
$other = $_GET['user_to'];

if(strcmp($user, $other) == 0){
    header("location: index.php");
}

require "db/mysql_credentials.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE chat SET Is_read = 1 WHERE User_from = '".$other."' and User_to = '".$user."'";

if (!($conn->query($sql) === TRUE)) {
    die("Error: " . $sql . "<br>" . $conn->error);
}

?>
<head>
    <title>Site Name</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/live_chat.css" />
    <link rel="stylesheet" media="all" href="css/bootstrap-category.css" />
    <script src="js/common.js"></script>
    <script src="js/chat.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>

<div class="backimgchat">
<div class="chat-window col-xs-10 col-md-10 col-lg-10" id="chat_window_1">
    <div class="col-xs-12 col-md-12">
        <?php
            echo'
                <div class="panel panel-default">
                    <div class="panel-heading top-bar">
                        <div class="col-md-9 col-xs-11">
                            <h3 class="panel-title"><i class="fa fa-comment my-comment"></i><chat_with> Chat with</chat_with> '.$other.'</h3>
                        </div>
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
                    <div class="input-group">
                        <input type="hidden" id="user_to" value="'.$other.'">
                        <textarea id="input-message" class="form-control input-sm chat_input"></textarea>
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" onclick="async_send_message()">Send <i class="fa fa-angle-right" style="color: black;"></i></button>
                        </span>
                    </div>
                </div>
            </div>';
        ?>
    </div>
</div>
</div>


<?php
require "footer.php";

?>

</body>
</html>