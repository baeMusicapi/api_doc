<?php
include_once dirname(dirname(dirname(__FILE__))).'/app.php';

$fileName = $_GET['file'];
$fileName = ROOT_PATH . "/temp/{$fileName}.txt";

if(!file_exists($fileName)){
	echo "No file !";
	exit;
}

$file = new File($fileName);
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
foreach ($content as $lineRaw){
	
	$line = trim($lineRaw);
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
				$urlInfo = parse_url($interface['url']);
				$query = $urlInfo['query'];
				parse_str($query,$queryInfo);
				$method = explode('.', $queryInfo['method']);
				$interface['category'] = $method[2];
				$method = $method[2].'.'.$method[3];
				$interface['name'] = $method;
				
				break;
			case 3:	
				$line = str_replace("\t", ' ', $line);
				list($pname,$pInfo) = explode(' ', $line,2);
				if(strpos($pInfo, '必选') !== false){
					$must = 1;
				} else {
					$must = 0;
				}
				
				
				$fristChar = substr($pname,0,1);
				if(preg_match('/[a-zA-Z]/',$fristChar)){
					$interface['parameters'][$pname] = array(
						'name' => trim($pname,':'),
						'comment' => $pInfo,
						'must' => $must,
					);
				}
				

				break;
			case 4:
				$lineRaw = trim($lineRaw,'|#');
				$interface['result'] .= $lineRaw . "<br />";
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

if($_GET['action'] == 'do'){
	$categoryList  = Lib_Category::getCategoryList(Lib_Category::TYPE_API);
	$categoryList = Util_Array::AssColumn($categoryList, 'name');
	foreach ($interfaces as $interfaceInfo){
		$condition = array('name' => $interfaceInfo['name']);
		if(DB::Exists('interface', $condition)){
			continue;
		}
		DB::Debug(true);
		$interface = array(
			'name' => $interfaceInfo['name'],
			'title' => $interfaceInfo['title'],
			'url' => $interfaceInfo['url'] ? $interfaceInfo['url'] : '',
			'result' => $interfaceInfo['result'],
			'category_id' => $categoryList[$interfaceInfo['category']] ? $categoryList[$interfaceInfo['category']]['id'] : 0, 
		);
		
		if($interfaceInfo['parameters']){
			$interface['parameters'] = $interfaceInfo['parameters'];
		}
		
		$result = Lib_Interface::Create($interface);
		if(!$result){
			dump(DB::$error);
		}
		DB::Debug(false);
	}
} else if($_GET['action'] == 'del'){
	DB::Debug();
	foreach ($interfaces as $interface){
		$condition = array('name' => $interface['name']);
		DB::Delete('interface', $condition);
	}
} else {
	dump($interfaces);
}

