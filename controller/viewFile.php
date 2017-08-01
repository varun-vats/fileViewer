<?php
require './../config/config.php';
$getDataUrl = "http://".$_SERVER['HTTP_HOST']."/".FILE_DATA_URL;
include('../views/list.html');
