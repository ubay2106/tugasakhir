<?php
session_start();

session_unset(); 

session_destroy(); 

header("Location: ../template/index.php");
exit;
?>
