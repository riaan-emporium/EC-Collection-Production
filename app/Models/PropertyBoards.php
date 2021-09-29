<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class PropertyBoards extends Sximo  {
	const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

	protected $table = 'tb_boards';
	protected $primaryKey = 'id';

	public function property()
    {
        return $this->belongsTo(properties::class, 'property_id');
    }

}