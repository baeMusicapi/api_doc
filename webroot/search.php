<?php
include_once dirname(dirname(__FILE__)).'/app.php';
$env = Lib_System::getEnvData();
$key = $_GET['key'];
$searchResult = Lib_Search::search($key);

$interfaceList = $searchResult['interface'];
$errorList = $searchResult['error'];
$categoryList = $searchResult['category'];

Template::Show();