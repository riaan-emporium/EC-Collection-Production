<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class customplan extends Sximo  {
	
	protected $table = 'tb_properties_custom_plan';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_properties_custom_plan.* FROM tb_properties_custom_plan  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_properties_custom_plan.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
