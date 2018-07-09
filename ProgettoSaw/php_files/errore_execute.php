<?php
    function error_execute()
    {
        echo "<script type='text/javascript'>alert('Execute Error');</script>";
        $stmt2->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
    }
?>