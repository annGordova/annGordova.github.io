<?php


header('Content-Type: text/html; charset=UTF-8');


session_destroy();
print('You have been logged out. <a href="index.php">Go back</a>');
?>