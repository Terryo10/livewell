<?php
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/public/upload/';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed'. $_SERVER['DOCUMENT_ROOT'].'/website/public/upload/';
?>
