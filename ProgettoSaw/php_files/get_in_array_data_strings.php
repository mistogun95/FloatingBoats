<?php
    function get_in_array_data_strings($conn, $_var_attribute_name, $_var_table_name, $_var_close_conn=true)
    {
        if ($conn->connect_error)
        {
            $conn->close();
            return false;
        }
        $stmtGeneric = $conn->prepare("SELECT ? FROM ?");
        $stmtGeneric->bind_param("ss",$_var_attribute_name, $_var_table_name);
        if(!$stmtGeneric->execute())
        {
            $stmtGeneric->close();
            $conn->close();
            return false;
        }
        $stmtGeneric->bind_result($_var_single_value_attribute);
        $array_to_result = array();
        while($stmtGeneric->fetch())
        {
            $array_to_result[] = $_var_single_value_attribute;
        }
        $stmtGeneric->close();
        if($_var_close_conn==true)
            $conn->close();
        return $array_to_result;
    }
?>