<?php

// Autoloader.php
spl_autoload_register(function ($class) {
    $classPath = 'Classes/' . $class . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});
