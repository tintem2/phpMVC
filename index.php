<?php
include 'config.php';
/*echo ROOT;
echo '<hr>';
echo IMG_BOOK;
exit;*/
include 'function.php';
if (!isset($_SESSION)) session_start();
spl_autoload_register('autoLoadClass');

$c= getIndex('controller','ProductController');
$obj = new $c();
