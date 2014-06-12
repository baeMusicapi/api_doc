<?php
class Lib_APICount{
	public static function totalCount($startDate = '',$endDate = ''){ 
		$dbMusicApiCount = new DB_MusicAPITotal();
		
		$condition = array();
		if($startDate){
			$condition[] = "count_date >= '{$startDate}'";
		}
		
		if($endDate){
			$condition[] ="count_date <= '{$endDate}'";
		}
		$option =array('order' => 'order by count_date desc');
		$data = $dbMusicApiCount->get($condition,$option);
		
		return $data;
	}
	
	public static function dailyCount($date){
		if(!$date){
			return false;
		}
		
		$dbAPIStatus = new DB_MusicAPIStatus();
		$dbMusicApiCount = new DB_MusicAPITotal();
		$dbMusicAPI = new DB_MusicAPI();
		
		$condition = array(
				'count_date' => $date,
		);
		
		$option = array(
				'select' => 'pv*average_time all_time,pv,music_api_id,count_date,average_time',
				'order' => 'order by all_time desc',
		);
		
		$totalInfo = $dbMusicApiCount->get($condition,array('one' => true)); //一天的总数据
		$apiStatusList = $dbAPIStatus->get($condition,$option);//一天的具体数据
		$apiList = $dbMusicAPI->get();//所有接口
		$apiList = Util_Array::AssColumn($apiList, 'id');
		
		$sumPV = $totalInfo['pv'];
		$totalAverage = $totalInfo['average_time'];
		
		foreach ($apiStatusList as $index => $one){
			if($apiList[$one['music_api_id']]){
				$one['name'] = strip_tags(($apiList[$one['music_api_id']]['name']));
			}
			$one['total_average_time'] = round(floatval($one['all_time']) / $sumPV,2);
			$one['total_average_rate'] = (round($one['total_average_time'] / $totalAverage,2)*100) .'%';
			$apiStatusList[$index] = $one;
		}
		
		$result = array(
			'api_list' => $apiStatusList,
			'total' => $totalInfo,
		);
		return $result;
	}
	
}