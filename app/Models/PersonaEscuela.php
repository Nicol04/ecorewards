<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaEscuela extends Model
{
	protected $table = 'persona_escuela';
	protected $primaryKey = 'idPersonaEscuela';
	public $timestamps = false;

	protected $casts = [
		'idpersona' => 'int',
		'idescuela' => 'int',
		'grado' => 'int'
	];

	protected $fillable = [
		'idpersona',
		'idescuela',
		'grado',
		'seccion'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'idpersona');
	}

	public function escuela()
	{
		return $this->belongsTo(Escuela::class, 'idescuela');
	}
}
