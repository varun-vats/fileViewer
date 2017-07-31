<?php
require './../config/config.php';
require '../vendor/autoload.php';
$fileData['page'] = $_POST['page'];
$fileData['path'] = $_POST['path'];
$fileData['type'] = $_POST['type'];
$fileViewer = FileViewFactory::getInstance()->getFileViewManager();
$fileContents = $fileViewer->getContents($fileData);
echo json_encode($fileContents);die;
