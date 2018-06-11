<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("location: index.php");
}
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
    <link rel="stylesheet" media="all" href="css/insert.css" >
    <script src="js/common.js"></script>
    <script src="js/insert.js"></script>
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


<div class="backimginsert">
    <br><br>
    <div id="form-div">
        <form class="montform" action="script/insert_newBook.php" method="POST" id="reused_form" enctype="multipart/form-data">
            <p class="title">Book Information</p>
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
                <input name="pages" type="number" required class="feedback-input" id="pages" placeholder="Number of Pages"/>
            </p>
            <p class="edition">
                <input name="edition" type="text" required class="feedback-input" id="edition" placeholder="Edition"/>
            </p>
            <p class="isbn">
                <input name="isbn" type="text" required class="feedback-input" id="isbn" placeholder="ISBN"/>
            </p>
            <p>Cover</p>
            <p class="file">
                <input name="image" type="file" required id="image" class="feedback-input"/>
            </p>
            <p class="title">Book Categories</p>
            <div class="categories" id="categories">
                <input name="number_of_categories" type="hidden" value="1" id="number_of_categories">
                <section class="col col-6">
                    <select name="fac1" id="fac1" class="feedback-input" required onchange="selectCategory(1)">
                        <option value="not-selected" selected disabled>Faculty</option>
                        <?php

                        require "db/mysql_credentials.php";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT distinct Name FROM faculty";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                            $fac = $row['Name'];
                            if(strlen($fac) != 0) {
                                echo "<option value='" . $fac . "'>" . $fac . "</option>";
                            }
                        }

                        $conn->close();

                        ?>
                    </select>
                </section>
                <section class="col col-6">
                    <select name="cat1" class="feedback-input" required  id="cat1" >
                        <option value="not-selected" selected disabled>Category</option>
                    </select>
                </section>
            </div>
            <br>
            <p class="categories">
                <button type="button" class="button-plus" onclick="addNewCategory()">Add New Category</button>
                <br><br>
            </p>
            <p class="title">Selling Information</p>
            <p class="price">
                <input name="price" type="number" required class="feedback-input" id="price" placeholder="Price"/>
            </p>
            <p class="place">
                <input name="place" type="text" required class="feedback-input" id="place" placeholder="Place"/>
            </p>
            <div class="submit">
                <button type="submit" class="button-blue">Submit</button>
                <div class="ease"></div>
            </div>
        </form>
        <br>
    </div>
</div>


<?php
require "footer.php";

?>

</body>
</html>