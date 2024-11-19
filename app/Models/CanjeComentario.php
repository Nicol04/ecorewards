<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CanjeComentario
 * 
 * @property int $idComentario
 * @property int $idcanje
 * @property string $fotoObjeto
 * @property string $comentario
 * @property Carbon $fechaComentario
 * @property int $puntuacion
 * 
 * @property Canje $canje
 *
 * @package App\Models
 */
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
		return $this->belongsTo(Canje::class, 'idcanje');
	}
}
