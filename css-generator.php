<?php

function getDirContents($dir)
{

    if (file_exists($dir) && is_dir($dir) ) {
        $handle = opendir($dir);
        print $dir .":" .PHP_EOL;

        if (!$handle) return array();
        {
            while ($entry = readdir($handle)) 
            {
                if (is_file($entry)) 
                {
                    $filelist = glob($handle . "*.png");
                    
                    foreach ($filelist as $file_list)
                    {
                        $file_path = '.' .$file_list;
                        $filelist = $entry;
                        $filelist = array();
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
    //imagefill($img, 0, 0, $background);
    //imagealphablending($img, false);
    //imagesavealpha($img, true);

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
    }

    imagecopy($img, $tmp, $position, 0, 0, 0, $imgwidth, $imgheight);
    $position += ($spacing + $imgwidth);
    
    //affiche l'image
    if (empty($path_gen))
    {
        header('Content-Type: image/png');
        imagepng($img, 'sprite.png');
    }
    else 
    {
        imagepng($img, $path_gen);
    }
    imagedestroy($tmp);

}

getDirContents('/home/wac/daisyB-repo/css_generator');