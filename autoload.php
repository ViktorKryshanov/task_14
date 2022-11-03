<?php

    function loader($classname)
    {
        echo $classname;
        echo '<br>';
        $find = 'Interfaces';
        if(strpos($classname, $find)) {
            require_once 'interfaces/' . $classname . '.php';
        } else {
            require_once 'entities/' . $classname . '.php';
        }
    }

    spl_autoload_register(loader);

