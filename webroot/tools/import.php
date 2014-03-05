<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';


$filename = ROOT_PATH . "/temp/song.txt";

$file = new File($filename);
$content = $file->readALL();
/*
 * 1: start
 * 2: url
 * 3: parameter
 * 4: result;
 * 5: error_code
 */
$action = 1;
$interface = array();
foreach ($content as $line){
	$line = trim($line);
	if(strstr($line,'|') !== false){
		$next = true;
	} else {
		$next = false;
	}
	
	if(strstr($line,'#') !== false){
		$end = true;
	} else {
		$end = false;
	}
	$line = trim($line,"|#");
	
	if($line){
		switch ($action){
			case 1:
				$interface['title'] .= $line;
				break;
			case 2:
				$interface['url'] = $line;
				break;
			case 3:	
				$line = str_replace("\t", ' ', $line);
				list($pname,$pInfo) = explode(' ', $line,2);
				
				$fristChar = substr($pname,0,1);
				if(preg_match('/[a-zA-Z]/',$fristChar)){
					$interface['paramters'][$pname] = array(
						'title' => $pname,
						'comment' => $pInfo,
					);
				}
				

				break;
			case 4:
				$interface['result'] .= $line . "\n";
				break;
			case 5:
					
				break;
		}
	}
	
	if($next){
		$action++;
	}
	
	if($end){
		$interfaces[] = $interface;
		$interface = array();
		$action = 1;
		$title = '';
		$url = '';
	}
}

dump($interfaces);