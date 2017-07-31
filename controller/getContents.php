<?php
require '../vendor/autoload.php';
$fileData['page'] = $_POST['page'];
$fileData['path'] = $_POST['path'];
$fileData['type'] = $_POST['type'];
//$fileData['path'] = "/var/www/fileViewer/test1";
//$fileData['type'] = "last";
$fileViewer = FileViewFactory::getInstance()->getFileViewManager();
$fileContents = $fileViewer->getContents($fileData);
echo json_encode($fileContents);die;
