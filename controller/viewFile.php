<?php
require './../config/config.php';
$getDataUrl = $_SERVER['HTTP_HOST']."/".FILE_DATA_URL;
readfile('../views/list.html');
