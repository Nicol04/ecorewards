<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
		return $this->belongsTo(Usuario::class, 'idusuario', 'idUsuario');
	}

	public function escuelas()
	{
		return $this->belongsToMany(Escuela::class, 'persona_escuela', 'idpersona', 'idescuela')
					->withPivot('idPersonaEscuela', 'grado', 'seccion');
	}
}
