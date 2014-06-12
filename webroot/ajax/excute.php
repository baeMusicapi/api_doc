<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';


$action = $_GET['action'];


switch($action){
	case 'interface_form':
		$interfaceID = $_GET['id'];
		$interface = Lib_Interface::Fetch($interfaceID);
		
		Template::Show('ajax/excute/interface_form.html');
		break;
}