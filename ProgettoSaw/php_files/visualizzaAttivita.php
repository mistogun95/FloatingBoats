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
    echo $NomeB;
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script type="text/javascript">
            function maps()
            {
                var lat = "<?php echo $CNord; ?>";
                var lon = "<?php echo $CSud; ?>";
                var zoom = 13;

                var lonLat = new OpenLayers.LonLat (lon, lat)
                                .transform (
                                    new OpenLayers.Projection("EPSG:4326"), 
                                    map.getProjectionObject()
                                );
            }
        </script>
    <body onload="maps()">
        <span style="font-family: Arial; font-weight: bold;">Esempio di mappa OSM</span>
        <div style="width:100%; height:95%" id="map"></div>
    </body>
</html>