<?php
include_once dirname(dirname(__FILE__)).'/app.php';

$defaultID = $_REQUEST['interface_id']; //默认


$allInterface = Lib_Interface::getList();
$allInterface = Util_Array::AssColumn($allInterface, 'id');

$defaultInterface = $allInterface[$defaultID] ? $allInterface[$defaultID] : current($allInterface);


Template::Show();