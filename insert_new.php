<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>
<head>
    <title>Site Name</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <link rel="stylesheet" media="all" href="css/footer.css" />
    <link rel="stylesheet" media="all" href="css/common.css" />
    <link rel="stylesheet" media="all" href="css/Home.css" />
    <script src="js/common.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="css/insert.css" >
    <script src="js/insert.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>

<body>

<?php
require "navbar.php";
?>

<div class="container">
    <div id="form-main">
        <div id="form-div">
            <form class="montform" action="Insert_newBook.php" method="POST" id="reused_form" enctype=&quot;multipart/form-data&quot; >
                <p class="author">
                    <input name="author" type="text" class="feedback-input" required placeholder="Author" id="author" />
                </p>
                <p class="title">
                    <input name="title" type="text" required class="feedback-input" id="title" placeholder="Title" />
                </p>
                <p class="text">
                    <textarea name="description" class="feedback-input" id="description" placeholder="Description"></textarea>
                </p>
                <p class="pages">
                    <input name="pages" type="number" required class="feedback-input" id="pages" placeholder="Number of Pages"></input>
                </p>
                <p class="edition">
                    <input name="edition" type="text" required class="feedback-input" id="edition" placeholder="Edition"></input>
                </p>
                <p class="isbn">
                    <input name="isbn" type="text" required class="feedback-input" id="isbn" placeholder="ISBN"></input>
                </p>

                <p>Cover</p>
                <p class="file">
                    <input name="image" type="file" required id="image" class="feedback-input">
                </p>
				
				<!--TODO!! Inserimento categorie e info -> prezzo, zona etc -->
                <div class="submit">
                    <button type="submit" class="button-blue">SUBMIT</button>
                    <div class="ease"></div>
                </div>
            </form>
            <div id="error_message" style="width:100%; height:100%; display:none; ">
                <h4>
                    Error
                </h4>
                Sorry there was an error sending your form.
            </div>
            <div id="success_message" style="width:100%; height:100%; display:none; "> <h2>Success! Your Message was Sent Successfully.</h2> </div>
        </div>
    </div>
</div>

<div class="myfooter">
  <small>
	Something to write in the footer
  </small>
  <div class="mynav">
    <ul>
      <li><a href="#"><i id="social-inf" class="fa fa-info fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-con" class="fa fa-address-book-o fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-fb" class="fa fa-facebook fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-tw" class="fa fa-instagram fa-2x social"></i></a></li>
      <li><a href="#"><i id="social-li" class="fa fa-linkedin fa-2x social"></i></a></li>
      <li><a href="mailto:boh@boh.it"><i id="social-em" class="fa fa-envelope fa-2x social"></i></a></li>
    </ul>
  </div>
</div>

</body>
</html>