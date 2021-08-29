<?php

use Ebcms\App;

require __DIR__ . '/../vendor/autoload.php';

if (version_compare(PHP_VERSION, '7.1.0', '<')) {
    header("Content-type: text/html; charset=utf-8");
    die('PHP >= 7.1');
}

App::getInstance()->run(__DIR__ . '/../');
