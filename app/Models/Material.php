<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $table = 'material';
	protected $primaryKey = 'idMaterial';
	public $timestamps = false;

	protected $casts = [
		'precioKg' => 'float'
	];

	protected $fillable = [
		'nombreMaterial',
		'precioKg'
	];

	public function reciclaje()
	{
		return $this->hasOne(Reciclaje::class, 'idmaterial', 'idMaterial');
	}
}
