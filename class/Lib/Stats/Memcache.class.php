<?php
class Lib_Stats_Memcache{
	
	public function getOnlineCacheInfo(){
		$cacheConfs = Config::Get('cache');
		$cacheInfos = array();
		foreach ($cacheConfs as $index => $cacheConfig){
			$cache = @Cache_Manage::getInstance($cacheConfig,Cache_Manage::CACHE_TYPE_MEMCACHE,$index);
			$cacheStatusList = @$cache->getStatus();
			if($cacheStatusList){
				foreach ($cacheStatusList as $server => $cacheStatus){
					$useRate = @round((doubleval($cacheStatus['bytes']) / $cacheStatus['limit_maxbytes']),2);
					$useRate = ($useRate * 100) . '%';
					$cacheStatus['use_rate'] = $useRate;
				
					$hitRate = @round(doubleval($cacheStatus['get_hits']) / ($cacheStatus['get_his'] + $cacheStatus['get_misses']),2);
					$hitRate = ($hitRate * 100) . '%';
					$cacheStatus['hit_rate'] = $hitRate;
				
					$cacheInfos[$index][$server] = $cacheStatus;
				}
			}
		}
		
		return $cacheInfos;
	}
}