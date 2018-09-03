<?php
    function take_user_profile_image($var_image, $var_directory)
    {
        if(!isset($var_image))
        {
            return $var_directory."default.png"; 
        }
        
        return $var_directory.$var_image;
        
    }
?>