<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
Lib_Admin::Logout();
Utility::Redirect('/admin/login.php');
