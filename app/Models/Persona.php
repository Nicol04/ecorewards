<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $idPersona
 * @property int $idusuario
 * @property string $nombre
 * @property string $apellido
 * @property Carbon $fechaNacimiento
 * @property string $direccion
 * @property string $telefono
 * @property string $genero
 * @property string $foto
 * 
 * @property Usuario $usuario
 * @property Collection|Escuela[] $escuelas
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'persona';
	protected $primaryKey = 'idPersona';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'fechaNacimiento' => 'datetime'
	];

	protected $fillable = [
		'idusuario',
		'nombre',
		'apellido',
		'fechaNacimiento',
		'direccion',
		'telefono',
		'genero',
		'foto'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function escuelas()
	{
		return $this->belongsToMany(Escuela::class, 'persona_escuela', 'idpersona', 'idescuela')
					->withPivot('idPersonaEscuela', 'grado', 'seccion');
	}
}
