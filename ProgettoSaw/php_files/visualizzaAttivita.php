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
        <div id="googleMap" style="width:75%;height:700px;"></div>
        <script>
            function myMap() 
            {
                var myCenter = new google.maps.LatLng(44.4073105,8.9340325);
                var mapCanvas = document.getElementById("googleMap");
                var mapOptions = {center: myCenter, zoom: 12, disableDefaultUI: true, mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, position: google.maps.ControlPosition.TOP_CENTER}};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({position:myCenter/*, animation:google.maps.Animation.BOUNCE, icon:'../Immagini/logo.png'*/});
                /*marker.setMap(map);
                var infowindow = new google.maps.InfoWindow({
                    content:"PESCALI TUTTI"
                });*/
                /*
                var mapOptions {
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    overviewMapControl: true,
                    rotateControl: true
                }
                */
                infowindow.open(map,marker);
                google.maps.event.addListener(marker,'click',function() {
                    var infowindow = new google.maps.InfoWindow({
                    content:"PESCALI TUTTI"
                    });
                infowindow.open(map,marker);
                });
                /*google.maps.event.addListener(marker,'click',function() {
                    map.setZoom(16);
                    map.setCenter(marker.getPosition());
                });*/
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhnvNJTfDyfVn08mAufLn9p1SA-DdhlXo&callback=myMap"></script>
    </body>
</html>