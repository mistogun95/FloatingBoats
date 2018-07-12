<?php
    session_start();
    if(isset($_GET["Utente"]))
        $user = $_GET["Utente"];
    else
        header("Refresh:0; URL=../Homepage.html");

    include "../db/mysql_credentials.php";
    include "take_user_date.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    else
    {
        $arrayDate = take_user_date($user, $conn, "../ImmaginiCaricate/");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
	    <meta name ="homepage" content ="homepage here" />
	    <meta name ="" content ="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/>
    </head>
    <body class>
        <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
            <a class="navbar-brand" href="../HomepagePersonale.php">
                <img src="../Immagini/logo1.png" alt="logo" style="width:60px;">
            </a>
            <!-- <ul class = "navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#AboutUs">AboutUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#contatti">Contattaci</a></li>
                <li class="nav-item"><a class="nav-link" href="php_files/get_data_profile.php">Profilo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Messaggi</a></li>
            </ul>  -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link btn btn-primary" href="../Logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <div class="bg">
        <div class="container h-100">
            <div class = "row h-100 justify-content-center align-items-center">
                <div class = "col-md-9">
                    <div class = "card">
                        <div class = "card-body">
                            <div class = "row">
                                <div class = "col-md-12 text-center">
                                    <img src = <?php echo '"'.$arrayDate[10].'"'?> alt = "avatar" class="mx-auto d-block" style="width:260px;" >
                                    <label><h4>Profilo Utente</h4></label>
		                            <hr>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-md-12">
                                        <div class = "form-group row">
                                            <label id = "username" class = "col-4 col-form-label">Username</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $user?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "name" class = "col-4 col-form-label">Name</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[7]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "surname" class = "col-4 col-form-label">Cognome</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[8]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "webSite" class = "col-4 col-form-label">Web Site personale</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[3]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "instagram" class = "col-4 col-form-label">Instagram</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[5]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "twitter" class = "col-4 col-form-label">Twitter</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[6]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "facebook" class = "col-4 col-form-label">Facebook</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[4]?></label>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "città" class = "col-4 col-form-label">Città</label>
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[1]?></label>
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Interessi</label> 
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[9]?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Descrizione</label> 
                                            <div class = "col-8">
                                                <label id = "username" class = "col-4 col-form-label"><?php echo $arrayDate[2]?></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-4 col-8">
                                            <a href="../FilePerChat/chat.php?userContact=<?php echo $user?>" class="btn btn-primary">Invia Messaggio</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>  