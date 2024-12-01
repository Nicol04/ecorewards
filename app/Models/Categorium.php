<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
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
		return $this->hasMany(Recompensa::class, 'idcategoria', 'idCategoria');
		
	}
}
