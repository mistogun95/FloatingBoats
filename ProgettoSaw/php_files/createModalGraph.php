<?php
    function creteAButtonModal($n,$IdNameModal,$nameButtonClose,$nameButton,$Latitudine,$Longitudine, $autore, $titolo, $descrizione)
    {
        echo "
        <!-- Button to Open the Modal -->
        <div class=\"container\">";
        createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine, $autore, $titolo, $descrizione, $n);
        echo "</div>";
    }
    
    /*************** START BUTTON MODAL **********************/
    function createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine, $autore, $titolo, $descrizione, $n)
    {
        $optional_string = " data-autore='".$autore."' ";
        $string_to_print = "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#".$IdNameModal."\"
        data-lat='".$Latitudine."' data-lng='".$Longitudine."' data-titolo='".$titolo."' data-descrizione='".$descrizione."' data-n='".$n."' ".$optional_string." >
        ".$nameButton."
      </button>";
      
      echo $string_to_print;
    }

    /****************** END BUTTON MODAL *******************/
    
    
/****************** START MODEL MODAL *******************/
    
    function createModalBootstrap($IdNameModal,$titleHeader,$textBody,$nameButtonClose,$Latitudine,$Longitudine,$bodyDown="\n")
    {
        echo "
        <!-- The Modal -->
                <div class=\"modal\" id=\"".$IdNameModal."\">
                <div class=\"modal-dialog\">
                <div class=\"modal-content\">";

            createHeaderModalBootstrap($titleHeader);
            createBodyModalBootstrap();
            //createFooterModalBootstrap($nameButtonClose);

        echo "</div>
                </div>
            </div>";
    }
    function createHeaderModalBootstrap($titleHeader)
    {
        echo "
        <!-- Modal Header -->
        <div class=\"modal-header\">
        <h4 class=\"modal-title\" id=\"titolo\"></h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>";
    }

    function createBodyModalBootstrap()
    {
        echo "
        <!-- Modal body -->
        <div class=\"modal-body\">
            <div class=\"row\">
                <div class=\"col-md-12 modal_body_content\">
                    <p id=\"descrizione\"></p>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-12 modal_body_map\">
                    <div class=\"location-map\" id=\"location-map\">
                        <div style=\"width: 600px; height: 400px;\" id=\"map_canvas\"></div>
                    </div>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-12 modal_body_end\">
                    <p>Eventa organizzato da: <a id='a1'></a></p>
                </div>
            </div>
         </div>";
    }

    function createFooterModalBootstrap($nameButtonClose)
    {
        echo "
        <!-- Modal footer -->
        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">".$nameButtonClose."</button>
            </div>";
    }
?>









