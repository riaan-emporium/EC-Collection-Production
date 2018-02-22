<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class qualityassurance extends Sximo  {
	
	protected $table = 'tb_quality_assurance';
	protected $primaryKey = 'quality_assurance_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_quality_assurance.* FROM tb_quality_assurance  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_quality_assurance.quality_assurance_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
