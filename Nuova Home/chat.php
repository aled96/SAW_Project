<!DOCTYPE html>
<html lang="en">

<?php
require "connectionDB.php";
	
if(!isset($_SESSION['username'])) {
    header("location: index.php");
}
$_SESSION['PrevPage'] = "chat.php";
?>
<head>
    
    <?php
		require "head.php";
	?>
    <link rel="stylesheet" media="all" href="css/chat.css" />
    <script src="js/all_chat.js"></script>

</head>

<body>

<?php
require "navbar.php";
?>
<h1><i class="fa fa-comments" style="font-size:40px"></i> Recent Chat</h1>

<?php

$user = $_SESSION['username'];

$sql = "SELECT distinct User_from, User_to, MAX(Datetime) as max_date FROM chat WHERE User_from = '".$user."' or User_to = '".$user."' GROUP BY User_from, User_to ORDER BY max_date desc";
$result = mySQLi_query($conn, $sql) or die("Error query1");
$list_users = array();

if($result->num_rows == 0) {
    echo '
    <div class="container snippet">
    </div>';
}
else {	
    echo '
    <div class="container snippet">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div id="all_chats" class="table-responsive">
                            <table class="table user-list">
                                
                                <thead>
                                <tr>
                                    <th><span>User</span></th>
                                    <th><span>Last Message</span></th>
                                    <th class="text-center"><span>Status</span></th>
                                </tr>
                                </thead>
                                <tbody id="tbody_chat">';

								while ($row = mySQLi_fetch_array($result)) {
									if (strcmp($_SESSION['username'], $row['User_from']) == 0)
										$other = $row['User_to'];
									else
										$other = $row['User_from'];
																			
									$key = array_search($other, $list_users);
									if ($key !== false) {
										continue;
									}
									array_push($list_users, $other);

									
									$otherPic = "https://bootdey.com/img/Content/user_1.jpg" ;
									
									$sql2 = "SELECT distinct ProfilePic FROM user WHERE Username = '".$other."'";
									$result2 = mySQLi_query($conn, $sql2) or die("Error query1");
									
									$row2 = mySQLi_fetch_array($result2);
									if($result2->num_rows > 0)
										$otherPic = "data:image/jpeg;base64,".base64_encode($row2['ProfilePic']);
									
									mysqli_free_result($result2);
									
									$sql3 = "SELECT COUNT(*) as count FROM chat WHERE Is_read = false and User_from = '" . $other . "' and User_to = '" . $user . "'";
									$result3 = mySQLi_query($conn, $sql3) or die("Error query");
									$row3 = mySQLi_fetch_array($result3);
									$unread_count = $row3['count'];
									
									mysqli_free_result($result3);
									echo '
										<tr><td>
											<img src="'.$otherPic.'" alt="" class="mini-image"/>
											<a class="name" href="view_chat.php?user_to=' . $other . '">' . $other . '</a>
										</td>
										<td>'.$row['max_date'].'</td>
										<td id="status' . $other . '" class="text-center">';
									if ($unread_count == 0)
										echo '<span class="label label-success">No Unread</span>';
									else
										echo '<span class="label label-warning">Unread (' . $unread_count . ')</span>';
									echo '</td>
										</tr>';
                                }

                                echo'
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

mysqli_free_result($result);

	?>



<?php
require "footer.php";

?>

</body>
</html>