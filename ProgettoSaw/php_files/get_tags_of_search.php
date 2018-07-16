<?php
    function spachetta($string)
    {
        $s = trim($string); //tolgo gli spazi e gli acapo.
        $array_s = explode(" ", $s);
        $array_string_to_replace = array("_","!","?",".",",","'");
        if(count($array_s)<=0)
            return false;
        $array_result = array();            
        foreach($array_s as $value)
        {
            foreach($array_string_to_replace as $value_reaplace)
                $value = str_replace($value_reaplace,"",$value);
            if($value == "")
                continue;
            if (!ctype_alpha($value))
                return false;
            $array_result[]=$value;
        }
        if(count($array_result)==0)
            return false;
        return $array_result;
    }
    session_start();
    if (isset($_POST["checkBoxTag"]))
    {
        $var_flag_titolo=null;
        $var_flag_tag = 1;  
    }
    else
    {
        $var_flag_titolo = 1;
        $var_flag_tag = null;
    }
    $array_Id = array();
    if(isset($var_flag_titolo))
    {
        $var_search = "Titolo";
        $var_get_post_title = $_POST['search2']; //inserire qua il post
        // echo "<br>".$var_get_post_title;

        $array = spachetta($var_get_post_title);
        // echo "flag_titolo settata<br>";
    }
    if(isset($var_flag_tag))
    {
        $var_search = "Tag";
        $array = array($_POST['search2']);//trim htmlspecialchar ecc da fare post per tag
        // echo "flag_tag settata<br>";
    }

    if(!isset($array))
    {
        //echo "array non definito<br>";
        //echo "<script type='text/javascript'>alert('array non definito');</script>";
        header("Refresh:0; URL=error.php");
    }
    $var_array_size = count($array);
    if($var_array_size==0)
    {
        //echo "array vuoto<br>";
        //echo "<script type='text/javascript'>alert('array vuoto');</script>";
        header("Refresh:0; URL=error.php");
    }
    include "../db/mysql_credentials.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        //echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=error.php");
    }
    else
    {
        
        // echo "array -> ".$var_array_size."<br><br>";
        if($var_array_size == 1)
        {
            $var_final_query=" SELECT ID,Titolo,Descrizione FROM Posts WHERE $var_search LIKE '%".$array[0]."%' GROUP BY ID,Titolo,Descrizione ";
        }
        else
        {
            $var_start_query = "SELECT ID, Titolo, Descrizione FROM Posts WHERE ";
            $var_start_query_moreThan1 =" SELECT ID, Titolo,Descrizione, COUNT(*)  as priority from ( " ;
            for($i=0; $i<$var_array_size; $i++)
            {
                if($i==0)
                {
                    $var_final_query = $var_start_query_moreThan1.$var_start_query." $var_search LIKE '%".$array[$i]."%' ";
                    $var_many_vars_to_bind_param ="s";
                    continue;
                }
                $var_final_query = $var_final_query." UNION ALL ".$var_start_query." $var_search LIKE '%".$array[$i]."%' ";
            }
            $var_final_query= $var_final_query." ) as tmp_table GROUP BY ID,Titolo,Descrizione ORDER by priority DESC";
        }
        $stmt = $conn->prepare($var_final_query);

        // echo "query -><br>".$var_final_query."<br><br>";
        // echo "bind_param -> ".$var_many_vars_to_bind_param."<br><br>";
        // echo "prima della execute<br>";
        if(!$stmt->execute())
        {
            //echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=error.php");
        }
        if($var_array_size == 1)
        {
            $stmt->bind_result($var_ID, $var_Titolo,$Descrizione);
            while($stmt->fetch())
            {
                if(isset($var_ID) && isset($var_Titolo) )
                {
                    $array_Id[] = $var_ID;
                }
            }
        }
        else
        {
            $stmt->bind_result($var_ID, $var_Titolo,$Descrizione,$var_count);
            while($stmt->fetch())
            {
                if(isset($var_ID) && isset($var_Titolo) )
                {
                    $array_Id[] = $var_ID;
                }
            }
        }   
        $stmt->close();
        $conn->close();
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
	    <meta name ="homepage" content ="homepage here" />
	    <meta name ="" content ="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/>
    </head>
    <body>
            <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
                <?php
                    if(isset($_SESSION["username"]))
                        echo "<a class=\"navbar-brand\" href=\"../HomepagePersonale.php\">";
                    else
                        echo "<a class=\"navbar-brand\" href=\"../Homepage.html\">";
                ?><img src="../Immagini/logo1.png" alt="logo" style="width:60px;"></a>
                <ul class="navbar-nav ml-auto">
                    <?php
                        if(isset($_SESSION["username"]))
                            echo "<li class=\"nav-item\"><a class=\"nav-link btn btn-primary\" href=\"../Logout.php\">Logout</a></li>"     
                    ?>
                </ul>
            </nav>
            <div class="table-responsive">
                <table class = "tabel table-hover table-bordered personalTable tableSearch">
                    <thead>
                        <tr>
                            <th>Nome Barca</th>
                            <th>Titolo</th>
                            <th>Numero Posti Barca</th>
                            <th>Data Inizio</th>
                            <th>Data Fine</th>
                            <th>Luogo di Ritrovo</th>
                            <th>Spesa totale viaggio</th>
                            <th>Descrizione</th>
                            <th>Strumentazione richiesta</th>
                            <th>Latitudine</th>
                            <th>Longitudine</th>
                            <th>Città</th>
                            <th>Autore post</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                            $query = "SELECT Nomebarca,Titolo,NumeroPostiBarca,DataInizio,DataFine,LuogoDiRitrovo,SpesaViaggioTotale,Descrizione,StrumentazioneRichiesta,Latitudine,Longitudine,Citta,UsernameAutore FROM Posts WHERE ID=?";
                            $stmt = $conn->prepare($query);
                            $n=1;
                            include "createModalGraph.php";
                            foreach($array_Id as $Id)
                            {
                                $stmt->bind_param("i", $Id);
                                $stmt->execute();
                                $stmt->bind_result($NomeB, $Titol, $NPosti, $Inizio, $Fine, $Ritrovo, $Spesa, $Descr, $Strumentazione, $Latitudine, $Longitudine, $citta, $autore);
                                $stmt->fetch();
                                echo "<tr>";
                                echo "<td >".$NomeB."</td>";
                                echo "<td id=\"titolo_td".$n."\">".$Titol."</td>";
                                echo "<td>".$NPosti."</td>";
                                echo "<td>".$Inizio."</td>";
                                echo "<td>".$Fine."</td>";
                                echo "<td>".$Ritrovo."</td>";
                                echo "<td>".$Spesa."</td>";
                                echo "<td id=\"descrizione_td".$n."\">".$Descr."</td>";
                                echo "<td>".$Strumentazione."</td>";
                                echo "<td>".$Latitudine."</td>";
                                echo "<td>".$Longitudine."</td>";
                                echo "<td>".$citta."</td>";
                                if(isset($_SESSION["username"]))
                                    $tmp1=" href=\"profiloUtente.php?Utente=".$autore."\"";
                                else
                                    $tmp0=" not-active";
                                echo "<td id=\"autore_td".$n."\" >"."<a class =\"btn btn-primary".$tmp0."\" ".$tmp1." >".$autore."</a></td>";
                                echo "<td>";
                                creteAButtonModal($n, "myModal","close","Visualizza mappa attività",$Latitudine,$Longitudine, $autore, $Titol, $Descr);
                                echo "</td>";
                                echo "</tr>";
                                $n++;
                            }
                            $stmt->close();
                            $conn->close();
                        ?>
                    </tbody>
                </table>
                <?php createModalBootstrap("myModal", $Titol, $Descr,"close",$Latitudine,$Longitudine); ?>
            </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhnvNJTfDyfVn08mAufLn9p1SA-DdhlXo&callback"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="printMapOfPost.js"></script>
    </body>
</html>

