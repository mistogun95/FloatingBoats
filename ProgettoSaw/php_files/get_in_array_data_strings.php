<?php
    function get_in_array_data_strings($conn, $_var_attribute_name, $_var_table_name, $_var_close_conn=true)
    {
        //echo "<br> prima i connect <br>";
        if ($conn->connect_error)
        {
            $conn->close();
            return false;
        }
        //echo "<br> prima i prepare <br>";
        $query = "SELECT ".$_var_attribute_name." FROM ".$_var_table_name;
        if(!$stmtGeneric = $conn->prepare($query))
        {
            if($_var_close_conn)
                $conn->close();
            /*echo "<br> prepare <br>";
            echo "<br> prima i prepare <br>SELECT ".$_var_attribute_name." FROM ".$_var_table_name."<br>";*/
            return false;
        }
        if(!$stmtGeneric->execute())
        {
            $stmtGeneric->close();
            if($_var_close_conn)
                $conn->close();
            echo "<br> execute <br>";
            return false;
        }
        $stmtGeneric->bind_result($_var_single_value_attribute);
        $array_to_result = array();
        while($stmtGeneric->fetch())
        {
            $array_to_result[] = $_var_single_value_attribute;
        }
        $stmtGeneric->close();
        if($_var_close_conn)
            $conn->close();
        return $array_to_result;
    }
?>