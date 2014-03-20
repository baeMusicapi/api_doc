<?php
class Cache_Adapter_ZCache implements Cache_Adapter_Model{
	const MAX_MULTI_SIZE = 64;//批量获取上限
	public $CZcacheObj = NULL;
	private $cacheLog = array();
	
	public function __construct(){
		
	}
	
	public function __destruct()
	{
		$this->CZcacheObj = NULL;
	}
	
	
	public function ini($cacheConf) {
		$this->CZcacheObj = new ZcacheAdapter(array(
			'pname'	=>	$cacheConf['pname'][RUNTIME],
			'token'	=>	$cacheConf['token'][RUNTIME],
			'host'	=>	$cacheConf['host'][RUNTIME]
		));
		
	}
	
	/**
	 * 添加数据
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param int $expire 过期时间
	 * @return bool
	 */
	public function add($key, $value, $expire = 0)
	{
		if(!$this->CZcacheObj)
		{
			return false;
		}
	
		$result = $this->CZcacheObj->addOne($key, NULL, serialize($value), $expire * 1000, 1, mt_rand());
		if($result){
			$this->cacheLog[$key] = true;
		}
		return $result;
	}
	
	/**
	 * 更新数据
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param int $expire 过期时间
	 * @return bool
	 */
	public function replace($key, $value, $expire = 0)
	{
		if(!$this->CZcacheObj)
		{
			return false;
		}
		return $this->CZcacheObj->updateOne($key, NULL, serialize($value), $expire * 1000, 1, mt_rand());
	}
	


	public function get($key) {
		if(!$this->CZcacheObj)
		{
			return false;
		}
		$ret = $this->CZcacheObj->getOne($key, NULL, 1, mt_rand());
		if(false === $ret)
		{
			$this->cacheLog[$key] = false;
			return false;
		}
		$data = unserialize($ret);
		if(false === $data)
		{
			$this->cacheLog[$key] = false;
			return false;
		}
		$this->cacheLog[$key] = true;
		return $data;
	}


	
	public function getMulti($keys) {
		if(!$this->CZcacheObj)
		{
			return false;
		}
		
		$count = count($keys);
		
		if($count>self::MAX_MULTI_SIZE){
			$lastKeys = array_slice($keys, self::MAX_MULTI_SIZE);
			$keys = array_slice($keys, 0,self::MAX_MULTI_SIZE);
			$lastData = $this->getMulti($lastKeys);
		}
		
		$data =  $this->CZcacheObj->getMultiple($keys, null,1,mt_rand());
		
		foreach ($keys as $key){
			if(isset($data[$key]) && $data[$key] !== false){
				$this->cacheLog[$key] = true;
			} else {
				$this->cacheLog[$key] = false;
			}
		}
		
		if(UtilArray::isComResult($lastData)){
			$data = array_merge($data,$lastData);
		}
		return $data;
	}


	public function set($key, $value, $expire = 0) {
		if(!$this->CZcacheObj)
		{
			return false;
		}
		$cacheStatus = isset($this->cacheLog[$key]) ? $this->cacheLog[$key] : $this->get($key);
		if($cacheStatus !== false)
		{
			return $this->replace($key, $value, $expire);
		}
		return $this->add($key, $value, $expire);
		
	}


	public function setMulti($items, $expire = 0) {
		foreach ($items as $key => $value){
			$this->set($key, $value,$expire);
		}
	}


	public function delete($key, $timeout = 0) {
		unset($this->cacheLog[$key]);
		if(!$this->CZcacheObj)
		{
			return false;
		}
		return $this->CZcacheObj->deleteOne($key, NULL, $timeout * 1000, 1, mt_rand());
	}


	public function deleteMulti($keys, $timeout = 0) {
		foreach ($key as $key){
			$this->delete($key,$timeout);
		}
		
	}


	public function getStatus() {
		return 'ZCache no status function!';
	}

	
}