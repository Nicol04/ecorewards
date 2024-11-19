<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Punto
 * 
 * @property int $idPuntos
 * @property int $idusuario
 * @property int $totalPuntos
 * @property int $puntosUtilizados
 * @property int $puntosDisponibles
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Punto extends Model
{
	protected $table = 'puntos';
	protected $primaryKey = 'idPuntos';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'totalPuntos' => 'int',
		'puntosUtilizados' => 'int',
		'puntosDisponibles' => 'int'
	];

	protected $fillable = [
		'idusuario',
		'totalPuntos',
		'puntosUtilizados',
		'puntosDisponibles'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}
}
