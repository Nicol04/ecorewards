<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
		return $this->belongsTo(Usuario::class, 'idusuario', 'idUsuario');
	}
}
