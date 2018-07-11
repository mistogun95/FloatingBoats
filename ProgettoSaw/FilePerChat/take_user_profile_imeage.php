<?php
    function take_user_profile_image($user)
    {
        $var_directory = "../ImmaginiCaricate/";
        $arrayType = array("jpg", "png", "jpeg");

        for ($i=0; $i < 3; $i++)
        {
            if(file_exists($var_directory.$user.".".$arrayType[$i]))
            {
                $imagePath = $var_directory.$user.".".$arrayType[$i];
                return $imagePath;
            }
        }

        $imagePath = $var_directory."default.png";
        return $imagePath;
    }
?>