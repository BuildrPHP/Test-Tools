<?php

$autoloadFile = __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

if(!file_exists($autoloadFile)) {
    echo 'The dependencies not installed! (Auto-load file not found!)';
    exit(1);
}

include_once $autoloadFile;

//Create constants for tests
define('EXAMPLES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'examples' . DIRECTORY_SEPARATOR . 'DataSet');
