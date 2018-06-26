<?php

    include "CleanUpDatabase/clean_table_Posts.php";
    include "CleanUpDatabase/clean_table_Tags.php";
    include "CleanUpDatabase/clean_table_Users.php";
    include "CleanUpDatabase/clean_db.php";
    
    $path = '../ImmaginiCaricate';
    $path_all_files = $path.'/*.*';
    echo $path_all_files;
    $flag = 1;
    foreach (glob($path_all_files) as $filename) 
    {
        if(!unlink($path_all_files))
        {
            echo 'NON è stato possibile cancellarei i files all\'interno della cartella<br>';

            $flag = 0;
        }
    }

    if($flag)
    {
        if(!rmdir($path)) {
            echo 'NON è stato possibile cancellare la cartella<br>';
        }
        else
        {
            echo 'La cartella è stata cancellata<br>';
        }
    }
    
    
?>
