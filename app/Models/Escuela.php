<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
class Escuela extends Model
{
	protected $table = 'escuelas';
	protected $primaryKey = 'idEscuela';
	public $timestamps = false;

	protected $fillable = [
		'nombreEscuela',
		'direccion',
		'direccionLink',
		'direccionUrl',
		'telefono',
		'director',
		'logoEscuela'
	];

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'persona_escuela', 'idescuela', 'idpersona')
					->withPivot('idPersonaEscuela', 'grado', 'seccion');
	}
}
