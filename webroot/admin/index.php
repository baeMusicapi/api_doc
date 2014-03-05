<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
$adminEnv = Lib_Admin::getEnvData();

$interfaceStatis = Lib_Interface::GetStatis();

$categoryList = Lib_Category::getCategoryList(Lib_Category::TYPE_API);

Template::Show();