<?php
session_start();
ini_set('display_errors','On');
    error_reporting(E_ALL);
    
    if(!isset($_SESSION["username"]))
        header("Refresh:0; URL=Homepage.html");
    else
        $username = $_SESSION['username'];
    include "db/mysql_credentials.php";
    include "php_files/take_user_date.php";
    include "FilePerChat/take_user_profile_imeage.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message = "Conn ERORR!! <br/>";
    }
    else
    {
        $arrayDate = take_user_date($username, $conn, "ImmaginiCaricate/");
    }
    $conn->close();

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
        <link rel="stylesheet" type="text/css" href="HomepageStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-md bg-info navbar-light sticky-top bg-inverse">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id="collapse_target">
                <a class="navbar-brand" href="HomepagePersonale.php">
                    <img src="Immagini/logo1.png" alt="logo" style="width:60px;">
                </a>
                <ul class = "nav navbar-nav">
                    <li class="nav-item"><a class="nav-link btn btn-primary" href="#AboutUs">AboutUs</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary" href="#contatti">Contattaci</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="modal" href="#myModal">Profilo</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="modal" href="#myModal2">Attività</a></li>
                    <li class="nav-item">
                    <div class="dropdown">
                        <button type="button" class=" nav-link btn btn-primary dropdown-toggle dropdown1" data-toggle="dropdown">
                            Messaggi
                        </button>
                        <div class="dropdown-menu">
                            <?php
                                include "db/mysql_credentials.php";
                                include "FilePerChat/take_user_in_contact.php";
                                $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                                take_user_in_contact($username, $conn);
                                $conn->close();
                            ?>
                            <a class="nav-link btn btn-primary" href="FilePerChat/chat.php?userContact=">Nuova conversazione</a>
                        </div>
                    </div> 
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link btn btn-primary" href="Logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

            <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="containerform" action="profile.php" method="POST">
      
            <!-- Modal Header -->
            <div class="modal-header card">
                <img class="card-img-top" src=<?php echo '"'.$arrayDate[10].'"'?> alt="Avatar" style="width:100%">
            </div>
      
            <!-- Modal body -->
            <div class="modal-body" style="width:400px">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $username?></h4>
                    <p class="card-text"><?php echo "<b>Nome: </b>".$arrayDate[7]?></p>
                    <p class="card-text"><?php echo "<b>Cognome: </b>".$arrayDate[8]?></p>
                    <p class="card-text"><?php echo "<b>Città: </b>".$arrayDate[1]?></p>
                    <p class="card-text"><?php echo "<b>Descrizione: </b>".$arrayDate[2]?></p>
                    <p class="card-text"><?php echo "<b>Sito Personale: </b>".$arrayDate[3]?></p>
                    <p class="card-text"><?php echo "<b>Facebook: </b>".$arrayDate[4]?></p>
                    <p class="card-text"><?php echo "<b>Instagram: </b>".$arrayDate[5]?></p>
                    <p class="card-text"><?php echo "<b>Twitter: </b>".$arrayDate[6]?></p>
                    <p class="card-text"><?php echo "<b>Interessi: </b>".$arrayDate[9]?></p>
                    <a href="php_files/profile.php?interessi_Get=<?php echo $arrayDate[9]?>" class="btn btn-primary">Modifica Profilo</a>
                </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
            </div>
        </form>
          </div>
        </div>
    </div>

      <!-- The Modal -->
      <div class="modal fade bs-example-modal-lg scrollmenu" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="classInfo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form class="containerform" action="profile.php" method="POST">
      
            <!-- Modal Header -->
            <div class="modal-header">
            </div>
      
            <!-- Modal body -->
            <div class="modal-body table-responsive">
            <table class = "tabel table-hover table-bordered personalTable">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th>Nome Barca</th>
                    <th>Titolo</th>
                    <th>Numero Posti Barca</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Luogo di Ritrovo</th>
                    <th>Spesa totale viaggio</th>
                    <th>Descrizione</th>
                    <th>Strumentazione richiesta</th>
                    <th>Latitudine</th>
                    <th>Longitudine</th>
                    <th>Città</th>
                    <th>Tag</th>
                </tr>
                <?php
                    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                    $query = "SELECT Nomebarca,Titolo,NumeroPostiBarca,DataInizio,DataFine,LuogoDiRitrovo,SpesaViaggioTotale,Descrizione,StrumentazioneRichiesta,Latitudine,Longitudine,Citta,Tag FROM Posts WHERE UsernameAutore=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($NomeB, $Titol, $NPosti, $Inizio, $Fine, $Ritrovo, $Spesa, $Descr, $Strumentazione, $Latitudine, $Longitudine, $citta, $tags);
                    while($stmt->fetch())
                    {
                        
                        echo "<tr>";
                        echo "<td>".$NomeB."</td>";
                        echo "<td>".$Titol."</td>";
                        echo "<td>".$NPosti."</td>";
                        echo "<td>".$Inizio."</td>";
                        echo "<td>".$Fine."</td>";
                        echo "<td>".$Ritrovo."</td>";
                        echo "<td>".$Spesa."</td>";
                        echo "<td>".$Descr."</td>";
                        echo "<td>".$Strumentazione."</td>";
                        echo "<td>".$Latitudine."</td>";
                        echo "<td>".$Longitudine."</td>";
                        echo "<td>".$citta."</td>";
                        echo "<td>".$tags."</td>";
                        echo "</tr>";

                    }
                    $stmt->close();
                    $conn->close();
                ?>
            </tbody>
        </table>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="php_files/formInserimentoAttivita.php" class="btn btn-primary">Inserisci Attività</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
            </div>
        </form>
          </div>
        </div>
    </div>

        <div class = "MainDiv">
            <div class = "LogoDiv">
            </div>

            <div class = "titleContainer">
                <div class = "title">
                    <h1 class = "greatTitle">Enjoy your Passion</h1>
                </div>  
            </div>
        </div>

        <div class="container-fluid bg-2 text-center" id = "AboutUs">
            <h3 class="margin">Che cosa puoi fare con noi?</h3>
            <p>Condividi la tua passione per il mare e tutto ciò che lo riguarda con la possibilità di metterti in contatto con altri appassionati comincia cercando qualcosa che possa essere di tuo interesse e unisciti a noi!!!</p>

            <form class="example" action="php_files/get_tags_of_search.php" style="margin:auto;max-width:300px" method="POST">
                <input type="text" placeholder="Search.." name="search2">
                <button type="submit"><i class="fa fa-search"></i></button>
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="" name="checkBoxTag">Ricerca per Tag
                </label>
            </form>
        </div>

        <div class = "Contatti_e_Social" id = "contatti">
            <table class="table table-borderless">
                <tr>
                    <th><label class="titleContacts">Contattaci</label></th>
                    <th><label class="social" align: left>Social</label></th>
                </tr>
                <tr>
                   <th><label class="emailC">Email: floatingBoats@gmail.com</label></th>
                        <th>
                            <a href="#" class="fa fa-facebook" align: left></a>
                            <a href="#" class="fa fa-twitter" align: left></a>
                            <a href="#" class="fa fa-instagram" align: left></a>
                        </th> 
                </tr>
                <tr>
                    <th><label class="telephoneC">Telefono: 010409055</label> </th>
                </tr>
                <tr>
                    <th><label class="mobilePhoneC">Telefono Cellulare: 3456789023</label></th>
                </tr>
            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html> 

