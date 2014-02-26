<?php
class Cache_Manage{
	const CACHE_TYPE_MEMCACHE = 1;
	const CACHE_TYPE_MEMCACHED = 2;
	const CACHE_TYPE_ZCACHE = 3;
	
	private static $_AdapterList = array();
	
	private $_cacheAdapter = null;
	
	/**
	 * 获取实例 目前只支持 memcache 和 memcached  
	 * 以后由新的cache形式可以再添加
	 * 
	 * @param unknown $cacheType
	 */
	public static function getInstance($cacheType = self::CACHE_TYPE_MEMCACHED){
		$cacheType = $cacheType ? $cacheType : self::CACHE_TYPE_MEMCACHED;
		
		if(!self::$_AdapterList[$cacheType]){
			$cacheAdapter->ini($servers);
			
			$cacheManage = new Cache_Manage($cacheAdapter);
			self::$_AdapterList[$cacheType] = $cacheManage;
		}
		
		return self::$_AdapterList[$cacheType];
	}

	public function __construct($cacheAdapter){
		$this->_cacheAdapter = $cacheAdapter;
	}
	
	public function set($key,$value,$expire = 0){
		return $this->_cacheAdapter->set($key, $value,$expire);
	}
	
	public function get($key){
		return $this->_cacheAdapter->get($key);
	}
	
	public function setMulti($items,$expire = 0){
		return $this->_cacheAdapter->setMulti($items,$expire);
	}
	
	public function getMulti($keys){
		return $this->_cacheAdapter->getMulti($keys);
	}
	
	public function delete($key,$timeout = 0){
		return $this->_cacheAdapter->delete($key,$timeout);
	}
	
	public function deleteMulti($keys,$timeout = 0){
		return $this->_cacheAdapter->deleteMulti($keys,$timeout);
	}
	
	public function getStatus(){
		return $this->_cacheAdapter->getStatus();
	}
	
	
	///////////////工具性方法
	public static function GenKey($key){
		$hash = dirname(__FILE__);
		$key = md5( $hash . $key );
		return $key;
	}
}