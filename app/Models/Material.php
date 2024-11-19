<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Material
 * 
 * @property int $idMaterial
 * @property string $nombreMaterial
 * @property float $precioKg
 * 
 * @property Reciclaje $reciclaje
 *
 * @package App\Models
 */
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
		return $this->hasOne(Reciclaje::class, 'idmaterial');
	}
}
