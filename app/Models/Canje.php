<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Canje
 * 
 * @property int $idCanje
 * @property int $idusuario
 * @property int $idrecompensa
 * @property Carbon $fechaCanje
 * @property int $puntosUtilizados
 * 
 * @property Recompensa $recompensa
 * @property Usuario $usuario
 * @property CanjeComentario $canje_comentario
 *
 * @package App\Models
 */
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
