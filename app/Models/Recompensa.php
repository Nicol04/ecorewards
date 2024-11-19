<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recompensa
 * 
 * @property int $idRecompensa
 * @property string $nombreRecompensa
 * @property string $descripcion
 * @property int $puntosRequeridos
 * @property int $stock
 * @property string $imagen
 * @property int $idcategoria
 * 
 * @property Categorium $categorium
 * @property Collection|Canje[] $canjes
 *
 * @package App\Models
 */
class Recompensa extends Model
{
	protected $table = 'recompensa';
	protected $primaryKey = 'idRecompensa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idRecompensa' => 'int',
		'puntosRequeridos' => 'int',
		'stock' => 'int',
		'idcategoria' => 'int'
	];

	protected $fillable = [
		'nombreRecompensa',
		'descripcion',
		'puntosRequeridos',
		'stock',
		'imagen',
		'idcategoria'
	];

	public function categorium()
	{
		return $this->belongsTo(Categorium::class, 'idcategoria');
	}

	public function canjes()
	{
		return $this->hasMany(Canje::class, 'idrecompensa');
	}
}
