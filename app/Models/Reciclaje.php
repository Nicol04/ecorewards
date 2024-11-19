<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reciclaje
 * 
 * @property int $idReciclaje
 * @property int $idusuario
 * @property Carbon $fechaReciclaje
 * @property int $idmaterial
 * @property float $cantidad
 * @property int $puntosObtenidos
 * 
 * @property Material $material
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Reciclaje extends Model
{
	protected $table = 'reciclaje';
	protected $primaryKey = 'idReciclaje';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'fechaReciclaje' => 'datetime',
		'idmaterial' => 'int',
		'cantidad' => 'float',
		'puntosObtenidos' => 'int'
	];

	protected $fillable = [
		'idusuario',
		'fechaReciclaje',
		'idmaterial',
		'cantidad',
		'puntosObtenidos'
	];

	public function material()
	{
		return $this->belongsTo(Material::class, 'idmaterial');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}
}
