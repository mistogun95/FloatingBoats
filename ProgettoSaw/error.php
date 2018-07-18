<?php
    if(isset($_SESSION["username"]))
        header("Refresh:5; URL=HomepagePersonale.php");
    else
        header("Refresh:5; URL=Homepage.php");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Errore</title>
	    <meta name ="homepage" content ="homepage here" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="error.css"/>
    </head>

    <body class="bg">
        <div>
        <div class="container align-left mexError">
            <div class="media-container-column mbr-white col-md-12">
                <h1 class="mbr-section-subtitle py-3 mbr-fonts-style display-5">
                    <span style="font-style: normal;">Pagina Errore</span>
                </h1>
                <h2 class="mbr-section-title py-3 mbr-fonts-style display-1">Oops! Qualcosa è andato storto verrai reindirizzato alla Homepage</h2>
                <p class="mbr-text py-3 mbr-fonts-style display-5">
                    Se il tuo browser non supporta il reindirizzamento automatico clicca sul pulsante sottostante
                </p>
                <div class="mbr-section-btn py-4">
                    <?php
                        if(isset($_SESSION["username"]))
                            echo "<a class=\"btn btn-primary display-4\" href=\"HomepagePersonale.php\">Ritorna alla Homepage</a>";
                        else
                            echo "<a class=\"btn btn-primary display-4\" href=\"Homepage.php\">Ritorna alla Homepage</a>";
                    ?>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>