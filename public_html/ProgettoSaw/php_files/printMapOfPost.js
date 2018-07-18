"use strict";
$(document).ready(function() 
{
  var map = null;
  var myMarker;
  var myLatlng;
  
  function initializeGMap(lat, lng) {
    myLatlng = new google.maps.LatLng(lat, lng);

    var myOptions = {
      zoom: 12,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    myMarker.setMap(map);
  }

  // Re-init map before show modal
  $('#myModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var n = button.data('n');
    var autore = document.getElementById("autore_td"+n).textContent;
    var descrizione = document.getElementById("descrizione_td"+n).textContent;
    var titolo = document.getElementById("titolo_td"+n).textContent;
    var longitudine = document.getElementById("longitudine"+n).textContent;
    var latitudine = document.getElementById("latitudine"+n).textContent;
    initializeGMap(latitudine, longitudine);
    var modal = $(this);
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
    try{
      var href = document.getElementById("href_a"+n).href;
      modal.find('#a1').attr("href", "profiloUtente.php?Utente="+autore);
      modal.find('#a1').attr("class", "btn btn-primary");
    }
    catch(err){console.log("x==null");}
    modal.find('#a1').text(autore);
    modal.find('#descrizione').text(descrizione);
    modal.find('#titolo').text(titolo);
  });

  // Trigger map resize event after modal shown
  $('#myModal').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);
  });
});