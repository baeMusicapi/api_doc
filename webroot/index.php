<?php
include_once dirname(dirname(__FILE__)).'/app.php';
$env = Lib_System::getEnvData();






////API
$showApiCategoryList = Lib_Interface::getCategoryWithInterface();

////error_code
$showErrorCategoryList = Lib_ErrorCode::getCategoryWithErrorCode();


Template::Show();