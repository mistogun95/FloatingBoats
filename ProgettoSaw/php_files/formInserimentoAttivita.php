<?php 
    include "../db/mysql_credentials.php";
    ini_set('display_errors','On');
    session_start();
    if(!isset($_SESSION["username"]))
        header("Location: ../error.php");
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
            <ul class = "navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#AboutUs">AboutUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#contatti">Contattaci</a></li>
                <li class="nav-item"><a class="nav-link" href="php_files/get_data_profile.php">Profilo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Messaggi</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="../Logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <div class="container h-100">
            <div class = "row h-100 justify-content-center align-items-center">
                <div class = "col-md-9">
                    <div class = "card">
                        <div class = "card-body">
                            <div class = "row">
                                <div class = "col-md-12 text-center">
                                    <label><h4>Inserisci Attività</h4></label>
		                            <hr>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-md-12">
                                    <form action="InserisciAttivita.php" method="POST" enctype="multipart/form-data">
                                        <div class = "form-group row">
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "boat" class = "col-4 col-form-label">Nome Barca</label>
                                            <div class = "col-8">
                                                <input name = "boatIn" placeholder = "Nome Barca" class = "form-control here" type = "text">
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "title" class = "col-4 col-form-label">Titolo</label>
                                            <div class = "col-8">
                                                <input name = "titleIn" placeholder = "Titolo" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "seats" class = "col-4 col-form-label">Numero Posti Barca</label>
                                            <div class = "col-8">
                                                <input name = "Nseats" placeholder = "Numero Posti Barca" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "start" class = "col-4 col-form-label">Data inizio attività</label>
                                            <div class = "col-8">
                                                <input name = "startIn" placeholder = "Data inizio attività" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "end" class = "col-4 col-form-label">Data fine attività</label>
                                            <div class = "col-8">
                                                <input name = "endIn" placeholder = "Data fine attività" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "place" class = "col-4 col-form-label">Luogo di ritrovo</label>
                                            <div class = "col-8">
                                                <input name = "placeIn" placeholder = "Luogo di ritrovo" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "totalCost" class = "col-4 col-form-label">Spesa viaggio totale</label>
                                            <div class = "col-8">
                                                <input name = "totalCostIn" placeholder = "Spesa viaggio totale" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "città" class = "col-4 col-form-label">Città</label>
                                            <div class = "col-8">
                                                <input name = "cittàIn" placeholder = "città di provenienza" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Tag</label> 
                                            <div class = "col-8">
                                                <?php
                                                    include "../db/mysql_credentials.php";
                                                    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                                                    $stmt = $conn->prepare("SELECT Name FROM Tags");
                                                    $contatore = 0;

                                                    if(!$stmt->execute())
                                                    {
                                                        echo "<script type='text/javascript'>alert('Execute Error');</script>";
                                                        $stmt->close();
                                                        $conn->close();
                                                        header("Location: ../error.php");
                                                    }

                                                    $stmt->bind_result($nameTags);
                                                    while($stmt->fetch())
                                                    {
                                                        echo  "<div class=\"form-check\">
                                                                <label class=\"form-check-label\">
                                                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"check".$contatore."\" value=\"".$nameTags."\"";
                                                        echo ">".$nameTags."
                                                                </label>
                                                                </div>";
                                                        $contatore++;
                                                    }
                                                    $stmt->close();
                                                    $conn->close();
                                                ?>
                                            </div>
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "instrumentation" class = "col-4 col-form-label">Strumentazione richiesta</label>
                                            <div class = "col-8">
                                                <input name = "instrumentationIn" placeholder = "Strumentazione richiesta" class = "form-control here" type = "text" required>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "Latitudine" class = "col-4 col-form-label">Latitudine</label>
                                            <div class = "col-8">
                                                <input name = "Latitudine" placeholder = "Latitudine" class = "form-control here" type = "text">
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "Longitudine" class = "col-4 col-form-label">Longitudine</label>
                                            <div class = "col-8">
                                                <input name = "Longitudine" placeholder = "Longitudine" class = "form-control here" type = "text">
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label for="publicinfo" class="col-4 col-form-label">Descrizione</label> 
                                            <div class = "col-8">
                                                <textarea name = "descrizione" cols = "40" rows = "4" class = "form-control" placeholder = "Inserisci descrizione attività" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-4 col-8">
                                                <button name="submit" type="submit" class="btn btn-primary">Inserisci Attività</button>
                                            </div>
                                        </div>
                                    </form>
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