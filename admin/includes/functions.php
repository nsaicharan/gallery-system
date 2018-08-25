<?php 

    function classAutoLoader($class) {
        $path = "includes/{$class}.php";

        if (is_file($path) ) {
            include($path);
        } else {
            die("<strong>Error:</strong> The file named {$class}.php was not found.");
        }
    }
    spl_autoload_register('classAutoLoader');

?>