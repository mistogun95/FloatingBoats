
<?php 
    include "../db/mysql_credentials.php";
    include_once "../FilePerChat/take_user_profile_imeage.php";
?>
<?php
    session_start();
    if(!isset($_SESSION["username"]))
        header("Location: ../error.php");
    
    include "../db/mysql_credentials.php"; 

    $username = $_SESSION['username'];
    
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message = "Errore connessione";
    }
    else
    {
        $stmt = $conn->prepare("SELECT FlagFoto, Citta, AboutMe, LinkWebSite, Facebook, Instagram, Twitter, Name, Surname FROM Users WHERE Username=?");
        $stmt->bind_param("s",$username);
        
        if(!$stmt->execute())
        {
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=../error.php");
        }
        
        $stmt->bind_result($var_FlagFoto, $var_Citta, $var_AboutMe, $var_LinkWebSite, $var_Facebook, $var_Instagram, $var_Twitter, $var_Name, $var_Surname);
        $stmt->fetch();
        
        if(isset($var_Name) && isset($var_Surname) )
        {
            $var_complete_path_new_image = take_user_profile_image($username, "../ImmaginiCaricate/");
        }
        else 
        {
            header("Refresh:0; URL=../error.php");
        }
        
        $stmt->close();

        $stmt = $conn->prepare("SELECT * FROM Tags");

        if(!$stmt->execute())
        {
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=../error.php");
        }
        $stmt->bind_result($var_Name_Tags);
        $array_tags_names = array();
        while($stmt->fetch())
        {
            $array_tags_names[] = $var_Name_Tags;
        }

        $stmt->close();
        $conn->close();
    }
?>
    

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Profilo Utente</title>
	    <meta name ="homepage" content ="homepage here" />
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
                                    <img src = <?php echo '"'.$var_complete_path_new_image.'"'?> alt = "avatar" class="mx-auto d-block" style="width:260px;" >
                                    <h4>Profilo Utente</h4>
		                            <hr>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-md-12">
                                    <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
                                        <div class = "form-group row">
                                            <label id = "immagine" class = "col-4 col-form-label">Cambia immagine di profilo</label>
                                            <div class = "col-8">
                                                <input type="file" name="fileDaCaricare" id="fileDaCaricare">
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "username" class = "col-4 col-form-label">Username</label>
                                            <div class = "col-8">
                                                <input id = "usernameIn" name = "usernameIn" placeholder = "Username" class = "form-control here" type = "text" value = <?php echo '"'.$username.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "name" class = "col-4 col-form-label">Name</label>
                                            <div class = "col-8">
                                                <input name = "nameIn" placeholder = "Nome" class = "form-control here" type = "text" value = <?php echo '"'.$var_Name.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "surname" class = "col-4 col-form-label">Cognome</label>
                                            <div class = "col-8">
                                                <input name = "surnameIn" placeholder = "Cognome" class = "form-control here" type = "text" value = <?php echo '"'.$var_Surname.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "webSite" class = "col-4 col-form-label">Web Site personale</label>
                                            <div class = "col-8">
                                                <input name = "webIn" placeholder = "Web Site personale" class = "form-control here" type = "text" value = <?php echo '"'.$var_LinkWebSite.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "instagram" class = "col-4 col-form-label">Instagram</label>
                                            <div class = "col-8">
                                                <input name = "instagramIn" placeholder = "pagina Instagram" class = "form-control here" type = "text" value = <?php echo '"'.$var_Instagram.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "twitter" class = "col-4 col-form-label">Twitter</label>
                                            <div class = "col-8">
                                                <input name = "twitterIn" placeholder = "pagina Twitter" class = "form-control here" type = "text" value = <?php echo '"'.$var_Twitter.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "facebook" class = "col-4 col-form-label">Facebook</label>
                                            <div class = "col-8">
                                                <input name = "faceIn" placeholder = "pagina Facebook" class = "form-control here" type = "text" value = <?php echo '"'.$var_Facebook.'"'?>>
                                            </div> 
                                        </div>
                                        <div class = "form-group row">
                                            <label id = "città" class = "col-4 col-form-label">Città</label>
                                            <div class = "col-8">
                                                <input name = "cittàIn" placeholder = "città di provenienza" class = "form-control here" type = "text" value = <?php echo '"'.$var_Citta.'"'?>>
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label id="interessi" class="col-4 col-form-label">Interessi</label> 
                                            <div class = "col-8">
                                                <?php
                                                    if(!isset($_GET['interessi_Get']))
                                                    {
                                                        $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                                                        include "get_interessi_of_user.php";
                                                        $interessi_Get = get_Interessi_query_of_user($username, $conn);
                                                    }
                                                    else
                                                        $interessi_Get = $_GET['interessi_Get'];
                                                    $array_s = explode(",", $interessi_Get);
                                                    $result_interessi = array();
                                                    foreach($array_s as $value)
                                                    {
                                                        if(strlen(htmlspecialchars(trim($value)))>0)
                                                        {
                                                            $result_interessi[] = htmlspecialchars(trim($value));
                                                        }
                                                    }
                                                    $contatore=1;
                                                    foreach($array_tags_names as $value)
                                                    {
                                                        $flag_presente = false;
                                                        if(in_array($value,$result_interessi) )
                                                            $flag_presente = true;
                                                        echo  "<div class=\"form-check\">
                                                                <label class=\"form-check-label\">
                                                                    <input type=\"checkbox\" class=\"form-check-input\" name=\"check[]\" value=\"".$value."\"";
                                                        if($flag_presente)
                                                            echo " checked";
                                                        echo " id = \"check".$contatore."\">";
                                                        echo $value."
                                                        </label>
                                                        </div>";
                                                        $contatore++;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label id="Descrizione" class="col-4 col-form-label">Descrizione</label> 
                                            <div class = "col-8">
                                                <textarea name = "descrizione" cols = "40" rows = "4" class = "form-control"><?php echo $var_AboutMe ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-4 col-8">
                                                <button name="submit" type="submit" class="btn btn-primary">Aggiorna Profilo</button>
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
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>        