<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class imapper extends Sximo  {
	
	protected $table = 'tb_container';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_container.* FROM tb_container  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_container.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
