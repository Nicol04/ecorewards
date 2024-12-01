<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
	protected $table = 'canjes';
	protected $primaryKey = 'idCanje';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'idrecompensa' => 'int',
		'fechaCanje' => 'datetime',
		'puntosUtilizados' => 'int'
	];

	protected $fillable = [
		'idusuario',
		'idrecompensa',
		'fechaCanje',
		'puntosUtilizados'
	];

	public function recompensa()
	{
		return $this->belongsTo(Recompensa::class, 'idrecompensa');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function canje_comentario()
	{
		return $this->hasOne(CanjeComentario::class, 'idcanje');
	}
}
