<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';
$fileName = $_GET['file'] ? $_GET['file'] : 'errmsg.conf.php';
$fileName = ROOT_PATH . "/temp/{$fileName}";

if(!file_exists($fileName)){
	echo "No file !";
	exit;
}

$file = new File($fileName);
$content = $file->readALL();

$errors = array();
foreach ($content as $one){
	if(strpos($one, 'define') !== 0){
		continue;
	}
	
	
	$errors[] = $one;
}

dump($errors);