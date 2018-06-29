<title>BookTrader</title>
    
<meta name="Lapolla, De Luca" content ="Lapolla Marco, De Luca Alessio" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<link href="http://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300|Poppins:400,500,700,300,600" rel="stylesheet" type="text/css">

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/footer.css">

<link rel="stylesheet" href="css/responsive.css">

<script src="js/common.js"></script>

<?php
if(isset($_SESSION['username'])) {
	echo '<script src="js/message_updates.js"></script>';
}
?>
