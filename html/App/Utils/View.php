<?php

namespace App\Utils;

trait View
{

    public static function render(string $template = "index",array $params = []): void
    {
        extract($params, EXTR_PREFIX_SAME, "_copy");
        
        $pathFile = $_SERVER['DOCUMENT_ROOT'] . BASEPATH . $template . ".php";
        
        if(file_exists($pathFile))
            require($pathFile);
        else
            throw new \Exception('not found template - '. $template);
        
    }    
}