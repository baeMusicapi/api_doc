<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';

$baiduOpen = new BaiduOpen();
$result = $baiduOpen->getAccessToken();

