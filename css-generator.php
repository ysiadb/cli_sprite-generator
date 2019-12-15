<?php

function getDirContents($path)
{

    if (file_exists($path) && is_dir($path) ) 
    {
        $handle = opendir($path);
        print_r($path .":" .PHP_EOL);


            while ($entry = readdir($handle)) 
            {
                if (is_file($entry)) 
                {
                    $filepng = glob(/*$handle .*/"*.png");
                    
                    foreach ($filepng as $file_png)
                    {
                        $file_path = '.' .$file_png;
                        $file_png = array($entry);
                        $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
                    }

                        print_r($entry) .PHP_EOL;
                }
            }
        }
    
    closedir($handle);
}
// $files= tableau chemin des fichiers, $path_gen = chemin pour sauvegarder l'image générée, largeur, hauteur, espace)
function sprite($files = array(), $path_gen = '', $imgheight = 100, $imgwidth = 100, $spacing = 0)
{
    $files_tmp = array();
    $width = 0;
    
    foreach ($files as $file) 
    {
        list($h, $w, $t) = getimagesize($file);

        if (($h == $imgheight) && ($w == $imgwidth))
        {
            $width += ($spacing + $imgwidth);
            $files_tmp[] = array('file' => $file, 'type' => $t);
        }
    }

    // creation de l'image vide
    $height = $imgheight;
    $img = imagecreatetruecolor($width, $height);
    $bgc = imagecolorallocate($img, 255, 255, 255);


    //ajout des images
    $position = 0;

    foreach ($files_tmp as $file)
    {
        if ($file['type'] == IMAGETYPE_PNG) 
        {
            $tmp = imagecreatefrompng($file['sprite.png']);
        }
        else 
        {
            die('ERREUR : Cette image n\'est pas au format PNG');
        }
        
        imagecopy($img, $tmp, $position, 0, 0, 0, $imgwidth, $imgheight);
        $position += ($spacing + $imgwidth);
        
        //affiche l'image
        //if (empty($path_gen))
        //{
            //header('Content-Type: image/png');
            imagepng($img, 'home/wac/daisyB-repo/css_generator/sprite.png');
            //}
            //else 
            //{
                //imagepng($img, $path_gen);
                //}
                //imagedestroy($tmp);
                
    }

}

getDirContents('/home/wac/daisyB-repo/css_generator');
sprite(array('mario.png', 'fortnite.png'), 'home/wac/daisyB-repo/css_generator/');
