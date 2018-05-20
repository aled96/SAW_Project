<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$_SESSION['PrevPage'] = "index.php";
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

    <link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/chat.css" />
    <script src="js/common.js"></script>
    <script src="js/chat.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>


<div id="wrapper">
    <div id="menu">
        <p class="welcome">Messages to <b></b></p>
        <div style="clear:both"></div>
    </div>

    <div id="chatbox">



    </div>

    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>


<?php
require "footer.php";

?>

</body>
</html>