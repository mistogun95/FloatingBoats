<?php
    function get_Interessi_query_of_user($username_to_query,$conn)
    {
        if ($conn->connect_error)
        {
            return false;
            $stmtGeneric->close();
            $conn->close();
        }
        $stmtGeneric = $conn->prepare("SELECT Interessi FROM Users WHERE Username=?");
        $stmtGeneric->bind_param("s", $username_to_query);
        $stmtGeneric->execute();
        $stmtGeneric->bind_result($result);
        $stmtGeneric->fetch();
        $stmtGeneric->close();
        $conn->close();
        return $result;
    }
?>