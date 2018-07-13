<?php
    function creteAButtonModal($n,$IdNameModal,$nameButtonClose,$nameButton,$Latitudine,$Longitudine, $autore, $isRegister=false)
    {
        echo "
        <!-- Button to Open the Modal -->
        <div class=\"container\">";
        createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine, $autore, $isRegister);
        echo "</div>";
    }
    
    /*************** START BUTTON MODAL **********************/
    function createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine, $autore, $isRegister)
    {
        $optional_string = " data-autore='".$autore."' ";
        if($isRegister===true)
            $optional_string = " data-autore='href=\"profiloUtente.php?Utente=".$autore."' ";
        $string_to_print = "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#".$IdNameModal."\"
        data-lat='".$Latitudine."' data-lng='".$Longitudine."' ".$optional_string." >
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
            createBodyModalBootstrap($textBody,$Latitudine,$Longitudine,$bodyDown);
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
        <h4 class=\"modal-title\">".$titleHeader."</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>";
    }

    function createBodyModalBootstrap($textBody,$Latitudine,$Longitudine,$bodyDown)
    {
        //$textBody1 = " <div id=\"".$n."\" onload=\"printMap(\"".$n."\",".$Latitudine.",".$Longitudine.")\"></div>";
        //$textBody1 = " <div id=\"".$n."\" style=\"width:85%;height:500px;\" onload=\"printMap(".$n.",".$Latitudine.",".$Longitudine.")\"></div>";

        echo "
        <!-- Modal body -->
        <div class=\"modal-body\">
            <div class=\"row\">
                <div class=\"col-md-12 modal_body_content\">
                    <p>".$textBody."</p>
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
                    <div class=\"myBody\">
                        <p>Evento proposto da: ".$bodyDown."</p>
                    </div>
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









