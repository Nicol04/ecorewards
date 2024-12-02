<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
		return $this->belongsTo(Material::class, 'idmaterial', 'idMaterial');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario', 'idUsuario');
	}
}
