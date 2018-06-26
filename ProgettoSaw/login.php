<!DOCTYPE html>
<html lang="it">
<head>
	<title>Confirming data page</title>
	<link rel="stylesheet" type="text/css" href="Homepage_Style.css"/>
	<meta name ="confirmingDataPage" content ="confirmingDataPage here" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8"/>
</head>

<body class=bodyData>
    
    <div class="myHeader">
		<ul class="horizontalBar">
			<li class="liHome"><a class="Home" href="Homepage.html">Home</a></li>
			<li class="liAbout"><a class="About" href="#about1">AboutUs</a></li>
			<li class="liContacts"><a class="Contact" href="#contatti">Contattaci</a></li>
			<li class="liNews"><a class="News" href="">News</a></li>
			<li class="liShop"><a class="Shop" href="">Negozio</a></li>
			<li class="liLogin" style="float:right"><a class="login" href="Logout.php">Logout</a></li>
		</ul>
	</div>
    
    <div class="Data_div">
        <?php
			session_start();

			$name = $_SESSION['name'];
			$surname = $_SESSION['surname'];

			echo "<label class='userDate'><b>Nome</b></label><br>";
            echo "<label class='userDate' id='name'><b>$name</b></label><br><br>";
            echo "<label class='userDate'><b>Cognome</b></label><br>";
			echo "<label class='userDate' id='surname'><b>$surname</b></label><br>";
        ?>
    </div>
</body>
</html>