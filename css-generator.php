<?php

function sprite($path, $tab_image = "sprite.png", $content = "style.css")
{
//     $is_ok = in_array('-r', $argv);

//     if(!$is_ok)
//     {
//         $tab_img = my_scandir($argv[1]);
//         sprite_gen($tab_img);
//     }
//     else
//     {
//         echo 'error' . PHP_EOL ;
//     }
// }


// function my_scandir($path)
// {
        //$files = [];
        
        if ($handle = opendir($path)) 
        {
            while (false !== ($entry = readdir($handle)))
            {                
                $array = array();

                foreach (glob('*.png') as $entry)
                {
                    array_push($array, $entry);
                    
                    // if ($entry != "." && $entry != "..")
                    // {
                    //     $files[] = $path . '/' . $entry;
                    // }
                }
            }
            print_r($array);
            //closedir($handle);
        }

        else
        {
            echo "ATTENTION /!\ : Le dossier n'existe pas." . PHP_EOL;
        }

        //return $files;
    //}


//         //Fonction sprite.png

// function sprite_gen($array)
// {
    $imgh = 400;
    $imgl = 400;
    $space = 0;
    $max_height = $imgh + $space + $imgh;
    $large = 0;
    $dst_x = 0;
    $array_img = array();


    foreach ($array as $imge) 
    {
        $size[] = getimagesize($imge);
		$src_w = $size[0];
        $src_h = $size[1];
        $large += ($space + $imgl);
        $array_img[] = array('image' => $imge);
    }
    print_r($size);
    
    $img = imagecreatetruecolor($large, $imgh);
    
    foreach ($array_img as $imge)
    {
    $src = imagecreatefrompng($imge['image']);
    imagecopy($img, $src, $dst_x, 0, 0, 0, $imgl, $imgh);
    $dst_x += ($space + $imgh);
    
    }
    
    
                
		//$content = ".image-". " {display: block; width: ".$src_w."px; height: ".$src_h."px; background: url('sprite.png') ".$dst_x."px 0;} ";
        
		//$dst_x += $size[0];
        
	
	//css_gen(implode("", $content));		
	imagepng($img, "sprite.png");
//}




    //fonction style.css
// function css_gen($content)
// {
	fopen("style.css", "a+");
	$content = $content;
	file_put_contents("style.css", $content);
//}

// //function sprite($argv)
// //{
//     $is_ok = in_array('-r', $argv);

//     if(!$is_ok)
//     {
//         $tab_image = my_scandir($argv[1]);
//         sprite_gen($tab_image);
//     }
//     else
//     {
//         echo 'error' . PHP_EOL ;
//     }
// //}
}

sprite($argv[1]);