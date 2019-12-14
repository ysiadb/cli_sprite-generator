<?php

$recursif = false;

function my_scandir($folder,$recursif, $ext=array('png')) 
{
    $files = array();
    $dir=opendir($folder);
    while($file = readdir($dir)) 
    {
        if($file == '.' || $file == '..') continue;
        if(is_dir($folder . '/' . $file)) 
        {
            if($recursif == true)
                $files = array_merge($files, my_scandir($folder . '/' . $file, $ext));
        } 
        else 
        {
            foreach($ext as $value) 
            {
                if(strtolower($value) == strtolower(substr($file, -strlen($value))))
                {
                    $files[] = $folder . '/' . $file;
                    break;
                }
            }
        }
    }
    closedir($dir);
    return $files;
}

my_scandir('css_generator', 'true');