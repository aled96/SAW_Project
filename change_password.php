<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$_SESSION['PrevPage'] ="setting.php";
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
    <link rel="stylesheet" media="all" href="css/login.css" />
    <script src="js/common.js"></script>
    <script src="js/changePassword.js"></script>

    <?php
    if(isset($_SESSION['username'])) {
        echo '<script src="js/message_updates.js"></script>';
    }
    ?>
</head>

<body>


  <?php
  require "navbar.php";
  ?>
     <?php

        if(isset($_SESSION['username'])){
            echo'
              <div class="backimg">
                <div class="body" id="settings">
                    <form action="script/changePassword.php" method="POST" name="changePasswordForm" class="sky-form" enctype="multipart/form-data">
                        <header>Change Password</header>';

            echo '
            <fieldset>
                <section>
                    <label class="input" >
                        <p class="errorLogin" id="errorSettingsBox"><br></p>
                    </label>
                </section>
                <section>
                    <label class="input">
                        Old Password
                    </label>
                    <label class="input">
                        <i class="icon-append icon-lock"></i>
                        <input type="password" id="oldPassChange" name="oldPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="">
                    </label>
                </section>

                <section>
                    <label class="input">
                        New Password
                    </label>
                    <label class="input">
                        <i class="icon-append icon-lock"></i>
                        <input type="password" id="newPassChange" name="newPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="">
                        <input type="hidden" id="pswEncryptChange" name="pswEncryptChange" value="">
                    </label>
                </section>
                
                <section>
                    <label class="input">
                        Repeat New Password
                    </label>
                    <label class="input">
                        <i class="icon-append icon-lock"></i>
                        <input type="password" id="repeatNewPassChange" name="repeatNewPassChange" onclick="removeErrorChange()" onkeyup="removeErrorChange()" value="">
                    </label>
                </section>

            </fieldset>

            <footer>
                <button type="button" onclick="checkPassword()" class="button">Submit</button>
            </footer>
        </form>
        <br><br>
    </div>
    </div>';
                }
            else
                header("location: index.php");
			?>


    <?php
    require "footer.php";

    ?>

</body>
</html>
