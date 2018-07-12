<?php
    function creteAButtonModal($n,$IdNameModal,$titleHeader,$textBody,$nameButtonClose,$nameButton,$Latitudine,$Longitudine)
    {
        echo "
        <!-- Button to Open the Modal -->
        <div class=\"container\">";
        createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine);
        //createModalBootstrap($IdNameModal,$titleHeader,$textBody,$nameButtonClose,$Latitudine,$Longitudine);
        echo "</div>";
    }
    
    /*************** START BUTTON MODAL **********************/
    function createButtonToModalBootstrap($nameButton,$IdNameModal,$Latitudine,$Longitudine)
    {
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#".$IdNameModal."\"
        data-lat='".$Latitudine."' data-lng='".$Longitudine."'>
        ".$nameButton."
      </button>";
    }

    /****************** END BUTTON MODAL *******************/
    
    
/****************** START MODEL MODAL *******************/
    
    function createModalBootstrap($IdNameModal,$titleHeader,$textBody,$nameButtonClose,$Latitudine,$Longitudine)
    {
        echo "
        <!-- The Modal -->
                <div class=\"modal\" id=\"".$IdNameModal."\">
                <div class=\"modal-dialog\">
                <div class=\"modal-content\">";

            createHeaderModalBootstrap($titleHeader);
            createBodyModalBootstrap($textBody,$n,$Latitudine,$Longitudine);
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

    function createBodyModalBootstrap($textBody,$Latitudine,$Longitudine)
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
                    <p>robA sotto</p>
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









