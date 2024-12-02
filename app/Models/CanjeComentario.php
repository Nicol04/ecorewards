<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class CanjeComentario extends Model
{
	protected $table = 'canje_comentario';
	protected $primaryKey = 'idComentario';
	public $timestamps = false;

	protected $casts = [
		'idcanje' => 'int',
		'fechaComentario' => 'datetime',
		'puntuacion' => 'int'
	];

	protected $fillable = [
		'idcanje',
		'fotoObjeto',
		'comentario',
		'fechaComentario',
		'puntuacion'
	];

	public function canje()
	{
		return $this->belongsTo(Canje::class, 'idcanje', 'idCanje');
	}
}
