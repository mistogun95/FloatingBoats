<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    include "../db/mysql_credentials.php";
    $id = $_GET["id_post"];
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    $query = "SELECT Nomebarca,Titolo,NumeroPostiBarca,DataInizio,DataFine,LuogoDiRitrovo,SpesaViaggioTotale,Descrizione,StrumentazioneRichiesta,CoordinataNord,CoordinataSud,Citta,UsernameAutore FROM Posts WHERE ID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($NomeB, $Titol, $NPosti, $Inizio, $Fine, $Ritrovo, $Spesa, $Descr, $Strumentazione, $CNord, $CSud, $citta, $autore);
    $stmt->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div id="googleMap" style="width:100%;height:400px;"></div>
        <script>
            function myMap() 
            {
                var CNord = "<?php echo $CNord ?>";
                var CSud = "<?php echo $CSud ?>";
                var mapProp= {
                    center:new google.maps.LatLng(CNord, CSud),
                    zoom:5,
                };
                var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=&callback=myMap"></script>
    </body>
</html>