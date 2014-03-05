<?php
$dbConfig = array();
////主数据库
$dbConfig['rw'] = array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => '123456',
	'name' => 'api_doc',
);


//只读数据库
$dbConfig['ro'] = array(
	'host' => 'localhost',
	'user' => 'root',	
	'password' => '123456',
	'name' => 'api_doc',	
);


$config['db'] = $dbConfig;