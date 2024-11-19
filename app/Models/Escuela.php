<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Escuela
 * 
 * @property int $idEscuela
 * @property string $nombreEscuela
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $director
 * @property string $logoEscuela
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Escuela extends Model
{
	protected $table = 'escuelas';
	protected $primaryKey = 'idEscuela';
	public $timestamps = false;

	protected $fillable = [
		'nombreEscuela',
		'direccion',
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
