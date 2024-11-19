<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorium
 * 
 * @property int $idCategoria
 * @property string $nombreCategoria
 * @property string $descripcion
 * 
 * @property Recompensa $recompensa
 *
 * @package App\Models
 */
class Categorium extends Model
{
	protected $table = 'categoria';
	protected $primaryKey = 'idCategoria';
	public $timestamps = false;

	protected $fillable = [
		'nombreCategoria',
		'descripcion'
	];

	public function recompensa()
	{
		return $this->hasOne(Recompensa::class, 'idcategoria');
	}
}
