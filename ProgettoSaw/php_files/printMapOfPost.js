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
    /*var autore = button.data('autore');
    var titolo = button.data('titolo');
    var descrizione = button.data('descrizione');*/
    var n = button.data('n');
    console.log(n);
    var autore = document.getElementById("autore_td"+n).textContent;
    console.log(autore);
    var descrizione = document.getElementById("descrizione_td"+n).textContent;
    console.log(descrizione);
    var titolo = document.getElementById("titolo_td"+n).textContent;
    console.log(titolo);
    /*var titolo = document.getElementById("myText1").value;
    var descrizione = button.data('descrizione');*/
    initializeGMap(button.data('lat'), button.data('lng'));
    var modal = $(this);
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
    modal.find('#a1').attr("href", "profiloUtente.php?Utente="+autore)
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