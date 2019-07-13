<?php
    spl_autoload_register(function ($class)
    {
        $classesPath =[
                'classes/','classes/files/','classes/database/'
        ,'classes/strings/' , "classes/globals/" ];
        foreach ($classesPath as $classPath) {
            if (file_exists($classPath."{$class}.php"))
            {
                require $classPath."{$class}.php";
                break;
            }
            else
            {
                continue;
            }
        }
    });