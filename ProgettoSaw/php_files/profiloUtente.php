<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header("Location: ../error.php");
        exit;
    }
    if(isset($_GET["Utente"]))
        $user = filter_var(htmlspecialchars(trim($_GET["Utente"])));
    else
    {
        header("Location: ../error.php");
        exit;
    }

    include "../db/mysql_credentials.php";
    include "take_user_date.php";
    include "../FilePerChat/take_user_profile_imeage.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        header("Location: ../error.php");
        exit;
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
                                    <div class="col social">
                                        <a href=<?php echo '"'.$arrayDate[4].'"'?>><img src="../Immagini/facebook.png" alt="facebook" style="width: 5%;"></a>
                                        <a href=<?php echo '"'.$arrayDate[6].'"'?>><img src="../Immagini/twitter.png" alt="twitter" style="width: 5%;"></a>
                                        <a href=<?php echo '"'.$arrayDate[5].'"'?>><img src="../Immagini/instagram.png" alt="instagram" style="width: 5%;"></a>
                                        <a href=<?php echo '"'.$arrayDate[3].'"'?>><img src="../Immagini/sitoPersonale.png" alt="facebook" style="width: 5%;"></a>
                                    </div>
                                    <label><h4>Profilo Utente</h4></label>
		                            <hr>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-md-12">
                                        <div class = "form-group row">
                                            <label id = "username" class = "col-4 col-form-label">Username</label>
                                            <div class = "col-8">
                                            <input id = "usernameIn" name = "usernameIn" placeholder = "Username" class = "form-control here" type = "text" value = <?php echo '"'.$user.'"'?> disabled>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "name" class = "col-4 col-form-label">Name</label>
                                            <div class = "col-8">
                                            <input name = "nameIn" placeholder = "Nome" class = "form-control here" type = "text" value = <?php echo '"'.$arrayDate[7].'"'?> disabled>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "surname" class = "col-4 col-form-label">Cognome</label>
                                            <div class = "col-8">
                                                <input name = "surnameIn" placeholder = "Cognome" class = "form-control here" type = "text" value = <?php echo '"'.$arrayDate[8].'"'?> disabled>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "città" class = "col-4 col-form-label">Città</label>
                                            <div class = "col-8">
                                                <input name = "cittàIn" placeholder = "città di provenienza" class = "form-control here" type = "text" value = <?php echo '"'.$arrayDate[1].'"'?> disabled>
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Interessi</label> 
                                            <div class = "col-8">
                                            <input name = "cittàIn" placeholder = "città di provenienza" class = "form-control here" type = "text" value = <?php echo '"'.$arrayDate[9].'"'?> disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Descrizione</label> 
                                            <div class = "col-8">
                                                <textarea name = "descrizione" cols = "40" rows = "4" class = "form-control" disabled><?php echo $arrayDate[2]?></textarea>
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