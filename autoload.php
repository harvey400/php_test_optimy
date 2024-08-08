<?php
const ROOT = __DIR__;

/**
 * Environment implementation
 * Note: We can install a composer package for env integration such
 * as Dotenv\Dotenv, but I want to use a raw approach on features we
 * are integrating since we are running using in a native PHP
 * approach
 */
$env = file_get_contents(ROOT."/.env");
$lines = explode("\n",$env);
foreach($lines as $line){
    preg_match("/([^#]+)\=(.*)/",$line,$matches);
    if(isset($matches[2])){
        putenv(trim($line));
    }
}

require_once (ROOT . '/Traits/SingletonTrait.php');
require_once (ROOT . '/Services/NewsService.php');
require_once (ROOT . '/Services/CommentService.php');