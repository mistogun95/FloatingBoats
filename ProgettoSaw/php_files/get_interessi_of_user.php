<?php
    function get_Interessi_query_of_user($username_to_query,$conn, $_var_close_conn=true)
    {
        if ($conn->connect_error)
        {
            $conn->close();
            return false;
        }
        $stmtGeneric = $conn->prepare("SELECT Interessi FROM Users WHERE Username=?");
        $stmtGeneric->bind_param("s", $username_to_query);
        $stmtGeneric->execute();
        $stmtGeneric->bind_result($result);
        $stmtGeneric->fetch();
        $stmtGeneric->close();
        if($_var_close_conn==true)
            $conn->close();
        return $result;
    }
?>