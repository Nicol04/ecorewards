<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaEscuela
 * 
 * @property int $idPersonaEscuela
 * @property int $idpersona
 * @property int $idescuela
 * @property int $grado
 * @property string $seccion
 * 
 * @property Persona $persona
 * @property Escuela $escuela
 *
 * @package App\Models
 */
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
