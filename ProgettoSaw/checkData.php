<!DOCTYPE html>
<html lang="it">
<head>
    <title></title>
	<meta name ="homepage" content ="homepage here" />
	<meta name ="" content ="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="HomepageStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class=bodyData>
    
	<nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
    	<a class="navbar-brand" href="Homepage.html">
        	<img src="Immagini/logo1.png" alt="logo" style="width:60px;">
    	</a>
    	<ul class = "navbar-nav">
        	<li class="nav-item"><a class="nav-link" href="#AboutUs">AboutUs</a></li>
        	<li class="nav-item"><a class="nav-link" href="#contatti">Contattaci</a></li>
    	</ul>
    	<ul class="navbar-nav ml-auto">
        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            	Accedi
        	</button>
        	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
            	Registrati
        	</button>
    	</ul>
    </nav>
    
    <div class="Data_div">
    <?php
        include "Registration_checkData.php";
    ?>
    </div>
</body>
</html>