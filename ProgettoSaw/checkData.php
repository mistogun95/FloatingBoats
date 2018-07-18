<!DOCTYPE html>
<html lang="it">
<head>
    <title>Registrazione</title>
	<meta name ="homepage" content ="homepage here" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="HomepageStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg">
    
    <div class="Data_div">
    <?php
		include "Registration_checkData.php";
		$message = checkData();
		echo "<label class='userPresent'><b>$message</b></label><br>";
    	header( "refresh:5;url=Homepage.php" );
    	echo "<a class='signIn' href='Homepage.php'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
    ?>
	</div>
	
</body>
</html>