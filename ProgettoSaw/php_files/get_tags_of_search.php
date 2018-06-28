<?php
    session_start();
$array = array("pesca","vela");//trim htmlspecialchar ecc da fare
    if(!isset($array))
    {
        //echo "array non definito<br>";
        echo "<script type='text/javascript'>alert('array non definito');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    $var_array_size = count($array);
    if($var_array_size==0)
    {
        //echo "array vuoto<br>";
        echo "<script type='text/javascript'>alert('array vuoto');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    include "db/mysql_credentials.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    else
    {
//SELECT ID,Titolo,COUNT(*) FROM Posts WHERE Tag LIKE '%vela%' GROUP BY ID,Titolo
//SELECT ID, Titolo, count(Tag LIKE '%vela%' or Tag Like '%paesaggio%') AS numeroDiTagContenuti FROM Posts WHERE Tag LIKE '%vela%' or Tag Like '%paesaggio%' GROUP BY ID,Titolo

//SELECT ID, Titolo,Descrizione, COUNT(*) as priority from ( SELECT ID, Titolo, Descrizione 
    //FROM Posts WHERE Tag like '%immersione%' UNION ALL SELECT ID, Titolo, Descrizione FROM Posts WHERE Tag like '%pesca%' ) as t GROUP BY ID,Titolo,Descrizione ORDER by priority DESC
        
    echo "array -> ".$var_array_size."<br><br>";
        if($var_array_size == 1)
        {
            $var_final_query=" SELECT ID,Titolo,Descrizione FROM Posts WHERE Tag LIKE '%".$array[0]."%' GROUP BY ID,Titolo,Descrizione ";
        }
        else
        {
            $var_start_query = "SELECT ID, Titolo, Descrizione FROM Posts WHERE ";
            $var_start_query_moreThan1 =" SELECT ID, Titolo,Descrizione, COUNT(*) as priority from ( " ;
            for($i=0; $i<$var_array_size; $i++)
            {
                if($i==0)
                {
                    $var_final_query = $var_start_query_moreThan1.$var_start_query." Tag LIKE '%".$array[$i]."%' ";
                    $var_many_vars_to_bind_param ="s";
                    continue;
                }
                $var_final_query = $var_final_query." UNION ALL ".$var_start_query." Tag LIKE '%".$array[$i]."%' ";
            }
            $var_final_query= $var_final_query." ) as tmp_table GROUP BY ID,Titolo,Descrizione ORDER by priority DESC";
        }
        $stmt = $conn->prepare($var_final_query);

        echo "query -><br>".$var_final_query."<br><br>";
        echo "bind_param -> ".$var_many_vars_to_bind_param."<br><br>";
        echo "prima della execute<br>";
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=Homepage.html");
        }
        if($var_array_size == 1)
        {echo "dentro if<br>";
            $stmt->bind_result($var_ID, $var_Titolo,$Descrizione);
            while($stmt->fetch())
            {
                if(isset($var_ID) && isset($var_Titolo) )
                {
                    echo $var_ID."---".$var_Titolo."---".$Descrizione."<br>";
                }
            }
        }
        else
        {echo "dentro else<br>";
            $stmt->bind_result($var_ID, $var_Titolo,$Descrizione,$var_count);
            while($stmt->fetch())
            {
                if(isset($var_ID) && isset($var_Titolo) )
                {
                    echo $var_ID."---".$var_Titolo."---".$Descrizione."---".$var_count."<br>";
                }
            }
        }
        $stmt->close();
        $conn->close();
    }
?>

