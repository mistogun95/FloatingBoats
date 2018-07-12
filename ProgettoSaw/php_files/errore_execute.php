<?php
    function error_execute($stmt, $conn)
    {
        echo "<script type='text/javascript'>alert('Execute Error');</script>";
        $stmt->close();
        $conn->close();
        header("Refresh:0; URL=../HomepagePersonale.php");
    }
?>