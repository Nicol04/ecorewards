<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
    return $this->belongsTo(Categorium::class, 'idcategoria', 'idCategoria');
}

	public function canjes()
	{
		return $this->hasMany(Canje::class, 'idrecompensa','idRecompensa');
	}
}
