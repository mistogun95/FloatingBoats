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
        <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
            <a class="navbar-brand" href="HomepagePersonale.php">
                <img src="Immagini/logo1.png" alt="logo" style="width:60px;">
            </a>
            <ul class = "navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#AboutUs">AboutUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#contatti">Contattaci</a></li>
                <li class="nav-item"><a class="nav-link" href="php_files/profile.php">Profilo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Messaggi</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="Logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class = "MainDiv">
            <div class = "LogoDiv">
            </div>

            <div class = "titleContainer">
                <div class = "title">
                    <h1 class = "greatTitle">Enjoy your Passion</h1>
                </div>  
                <?php
			        session_start();

			        $name = $_SESSION['name'];
                    $surname = $_SESSION['surname'];
                    $username = $_SESSION['username'];

			        echo "<label class='userDate'><b>Nome</b></label><br>";
                    echo "<label class='userDate' id='name'><b>$name</b></label><br><br>";
                    echo "<label class='userDate'><b>Cognome</b></label><br>";
			        echo "<label class='userDate' id='surname'><b>$surname</b></label><br>";
                ?>
            </div>
        </div>

        <div class="container-fluid bg-2 text-center" id = "AboutUs">
            <h3 class="margin">Che cosa puoi fare con noi?</h3>
            <p>Condividi la tua passione per il mare e tutto ciò che lo riguarda con la possibilità di metterti in contatto con altri appassionati comincia cercando qualcosa che possa essere di tuo interesse e unisciti a noi!!!</p>

            <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
                <input type="text" placeholder="Search.." name="search2">
                <button type="submit"><i class="fa fa-search"></i></button>
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
