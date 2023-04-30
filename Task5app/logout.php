<?php


header('Content-Type: text/html; charset=UTF-8');
$_GLOBALS['b'] = FALSE;
session_start();
session_destroy();
print('You have been logged out. <a href="index.php">Go back</a>');
?>