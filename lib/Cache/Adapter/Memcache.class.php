<?php
class Cache_Adapter_Memcache implements Cache_Adapter_Model{
	private $_node                  = array();
	private $_nodeData              = array();
	private static $_memcache       = array();
	private $_enable = true;
	
	
	public function __construct(){
		if(!class_exists('Memcache',false)){
			$this->_enable = false;
			return false;
		}
	}
	
	public function ini($servers) {
		if(!$this->_enable){
			return false;
		}
		
		foreach ($servers as $index => $server){
			$host = $server[0];
			$port = $server[1];
			$weight = $server[2]; //忽略虚拟节点
			
			$machine = "{$host}:{$port}:{$weight}";
			$this->_node[$machine] = $machine;
		}
	}


	public function get($key) {
		if(!$this->_enable){
			return false;
		}
		$memcache = $this->_getMemcache($key);
		
		if(!$memcache){
			return false;
		}
		
		$value =  $memcache->get($key);
		return $value;
	}


	public function getMulti($keys) {
		if(!$this->_enable){
			return false;
		}
		
		$valueArray = array();
		foreach ($keys as $key){
			$valueArray[$key] = $this->get($key);
		}
		return $valueArray;
	}


	public function set($key, $value, $expire = 0) {
		if(!$this->_enable){
			return false;
		}
		$memcache = $this->_getMemcache($key);
		
		if(!$memcache){
			return false;
		}
		$result = $memcache->set($key, $value,0,$expire);
		return $result;
	}


	public function setMulti($items, $expire = 0) {
		if(!$this->_enable){
			return false;
		}
		
		foreach ($items as $key => $value){
			$this->set($key, $value,$expire);
		}
	}


	public function delete($key, $timeout = 0) {
		if(!$this->_enable){
			return false;
		}
		$memcache = $this->_getMemcache($key);
		
		if(!$memcache){
			return false;
		}
		$result  = $memcache->delete($key,$timeout);
		return $result;
	}


	public function deleteMulti($keys, $timeout = 0) {
		if(!$this->_enable){
			return false;
		}
		
		foreach ($keys as $key){
			$this->delete($key,$timeout);
		}
	}
	
	public function getStatus(){
		if(!$this->_enable){
			return false;
		}
		$memcacheList = $this->_getAllMemcache();
		
		$statusInfo = array();
		foreach ($memcacheList as $key => $memcache){
			$statusInfo[$key] = $memcache->getStats();
		}
		return $statusInfo;
	}

	
	
	/**
	 * 通过cache键值 获取对应的memcache 对象
	 * 
	 * @param string $key cache键
	 * @return memcache 对象
	 */
	private function _getMemcache($key)
	{
		$server = $this->_lookup($key);
		list($host, $port) = explode(":", $server);
		$_memcache_host_key = $host .'_'. $port;
		if (!self::$_memcache[$_memcache_host_key]){
			$memcache = new Memcache();
			if (!$memcache->connect($host, $port)) {
				self::$_memcache[$_memcache_host_key]='';
				return false;
			}
			$memcache->setCompressThreshold(409600, 0.2);
			self::$_memcache[$_memcache_host_key] = $memcache;
		}
		return self::$_memcache[$_memcache_host_key];
	}
	
	/**
	 * 查找对应服务器
	 * 
	 * @param string $resource cache的键
	 * @return string 返回对应的服务器信息
	 */
	private function _lookup($resource){
		$_temp_node = array();
		foreach ($this->_node as $key=> $value) {
			$_temp_node[sprintf("%u", crc32($key.$resource))] = $key;
		}
		ksort($_temp_node);
		$_arr_host = each($_temp_node);
		return $_arr_host['value'];
	}
	
	/**
	 * 加载所有的memcache 服务
	 */
	private function _getAllMemcache(){
		foreach ($this->_node as $key => $server){
			list($host, $port) = explode(":", $server);
			$_memcache_host_key = $host .'_'. $port;
			if (!self::$_memcache[$_memcache_host_key]){
				$memcache = new Memcache();
				if (!$memcache->connect($host, $port)) {
					self::$_memcache[$_memcache_host_key]='';
					return false;
				}
				$memcache->setCompressThreshold(409600, 0.2);
				self::$_memcache[$_memcache_host_key] = $memcache;
			}
		}
		return self::$_memcache;
	}
	
	public function getServerFromKey($key){
		$server = $this->_lookup($key);
		return $server;
	}
}