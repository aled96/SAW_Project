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
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/chat.css" />
    <script src="js/common.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>

<h1><i class="fa fa-comments" style="font-size:40px"></i> Recent Chat</h1>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>User</span></th>
                                <th><span>Created</span></th>
                                <th class="text-center"><span>Status</span></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(!isset($_SESSION['username'])) {
                                header("location: index.php");
                            }
                            $servername = "localhost";
                            $username = "root";
                            $password = "password";
                            $dbname = "university_sharing";

                            $user = $_SESSION['username'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT distinct User_from, User_to FROM chat WHERE User_from = '".$user."' or User_to = '".$user."'";
                            $result = mySQLi_query($conn, $sql) or die("Error query");
                            $list_users = array();

                            while($row = mySQLi_fetch_array($result)){
                                if(strcmp($_SESSION['username'], $row['User_from']) == 0)
                                    $user = $row['User_to'];
                                else
                                    $user = $row['User_from'];

                                $key = array_search($user, $list_users);
                                if($key !== false)
                                {
                                    continue;
                                }
                                array_push($list_users, $user);

                                echo'
                                    <tr>
                                        <td>
                                            <img src="https://bootdey.com/img/Content/user_1.jpg" alt="">
                                            <a href="view_chat.php?user_to='.$user.'">'.$user.'</a>
                                        </td>
                                        <td>01/01/2018</td>
                                        <td class="text-center">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
                                    ';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require "footer.php";

?>

</body>
</html>