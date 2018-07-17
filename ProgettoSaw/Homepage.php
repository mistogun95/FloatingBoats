<?php
    session_start();
    if(isset($_SESSION["username"]))
        header("Location: HomepagePersonale.php");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>floatingBoats</title>
	    <meta name ="homepage" content ="homepage here" />
	    <!-- <meta name ="" content ="" /> -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="HomepageStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id="collapse_target">
                <a class="navbar-brand" href="Homepage.html">
                    <img src="Immagini/logo1.png" alt="logo" style="width:60px;">
                </a>
                <ul class = "navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#AboutUs" onclick="closeCollapse()">AboutUs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contatti" onclick="closeCollapse()">Contattaci</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="closeCollapse()">
                        Accedi
                    </button></li>
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1" onclick="closeCollapse()">
                        Registrati
                    </button></li>
                </ul>
            </div>
        </nav>

        <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="containerform" action="loginSessione.php" method="POST">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="titleLogin">Login</h4>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                    <label class="usernameP"><b>Username:</b></label><br>
                    <input name="username" placeholder="Inserisci l'username" type="text">
                    <br>
                    <label class="passwordP"><b>Password:</b></label><br>
                    <input type="password" name="password" placeholder="Inserisci Password">
                    <br><br>
                    <button type="submit">Login</button>
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
    <div class="modal" id="myModal1">
            <div class="modal-dialog">
              <div class="modal-content">
            <form name="registrationForm1" action="checkData.php" method="POST" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <label class="titleRegistration">Registration</label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                        <label class="nameP"><b>Nome:</b></label><br>
                        <input class="form" type="text" name="name" id="name" onkeyup="controllaNome()" placeholder="Inserisci Nome" required>
                        <label class="Insert" id="nameInsert"></label>
			            <br>
			            <label class="surnameP"><b>Cognome:</b></label><br>
                        <input class="form" type="text" name="surname" id="surname" onkeyup="controllaCognome()" placeholder="Inserisci Cognome" required>
                        <label class="Insert" id="surnameInsert"></label>
			            <br>
			            <label class="usernameP"><b>Username:</b></label><br>
			            <input class="form" name="username" id="username" onmouseout="controllaUsername()" type="text" placeholder="Inserisci Username" required>
                        <label class="Insert" id="usernameInsert"></label>
                        <br>
			            <label class="passwordP"><b>Password:</b></label><br>
                        <input class="form" type="password" name="password" id="password" onkeyup="controllaPassword()" placeholder="Inserisci Password" required>
                        <label class="Insert" id="passwordInsert"></label>
                        <br>
                        <label class="passwordP"><b>Carica immagine profilo(opzionale):</b></label><br>
			            <input type="file" name="fileDaCaricare" id="fileDaCaricare">
                        <br>
                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="registrationbtn"><b>Registrati</b></button>
                    <button type="button" class="cancelbtnr" onclick="cancellaCampi()"><b>Cancel</b></button>
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
                    <!-- <div class = "col-4 mx-auto text-center">
                        <img src="Immagini/logo1.png" alt="logo" style="width:20%;">
                    </div> -->
                    <h1 class = "greatTitle">Enjoy your Passion</h1>
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

            <div class = "Contatti_e_Social row" id = "contatti">
                    <div class ="col">
                        <label class="titleContacts">Contattaci</label>
                        <br>
                        <label class="emailC">Email: floatingBoats@gmail.com</label>
                        <br>
                        <label class="telephoneC">Telefono: 010409055</label>
                        <br>
                        <label class="mobilePhoneC">Telefono Cellulare: 3456789023</label> 
                    </div>
                    <div class="col social">
                        <a href=""><img src="../Immagini/facebook.png" alt="facebook" style="width: 15%;"></a>
                        <a href=""><img src="../Immagini/twitter.png" alt="twitter" style="width: 15%;"></a>
                        <a href=""><img src="../Immagini/instagram.png" alt="instagram" style="width: 15%;"></a>
                    </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="controllaNome.js"></script>
        <script src="controllaCognome.js"></script>
        <script src="controllaUsername.js"></script>
        <script src="controllaPassword.js"></script>
        <script src="cancellaCampi.js"></script>
        <script src="closeCollapse.js"></script>
  </body>
</html>