<?php


header('Content-Type: text/html; charset=UTF-8');
$GLOBALS['b'] = False;
session_start();
session_destroy();
print('You have been logged out. <a href="index.php">Go back</a>');
?>