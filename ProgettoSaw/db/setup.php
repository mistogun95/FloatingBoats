<?php

    include "UserDeploy/create_db.php";
    $path = '../ImmaginiCaricate';
    if(!mkdir($path)) {
        echo 'La cartella era già presente<br>';
    }
    else
    {
        echo 'La cartella creata<br>';
    }
    include "UserDeploy/create_table_Users.php";
    include "UserDeploy/seed_table_Users.php";
    include "UserDeploy/create_table_Tags.php";
    include "UserDeploy/seed_table_Tags.php";
    include "UserDeploy/create_table_Posts.php";
    include "UserDeploy/seed_table_Posts.php";
    
    include "UserDeploy/create_table_private_chat.php";
//    include "UserDeploy/seed_table_Posts.php";

    include "UserDeploy/create_table_mes.php";
//    include "UserDeploy/seed_table_Posts.php";
        
    

?>
