<?php
class DB_Interface extends DB_Model{
	public $tableName = 'interface';
	
	public function create($condition,$duplicateCondition = null){
		$condition['create_time'] = $condition['create_time'] ? $condition['create_time'] : time();
		$condition['update_time'] = $condition['update_time'] ? $condition['update_time'] : time();
		
		if($duplicateCondition){
			$duplicateCondition['update_time'] = $duplicateCondition['update_time'] ? $duplicateCondition['update_time'] : time();
		}
		return parent::create($condition,$duplicateCondition);
	}
	
	public function update($condition,$updateRow){
		$updateRow['update_time'] = $updateRow['update_time'] ? $updateRow['update_time'] : time();
		return parent::update($condition, $updateRow);
	} 
}