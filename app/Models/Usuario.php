<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario  extends Authenticatable
{
	protected $table = 'usuario';
	use Notifiable; 
	protected $primaryKey = 'idUsuario';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nombreUsuario',
		'tipoUsuario',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];
	protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
		
    }

	public function canjes()
	{
		return $this->hasMany(Canje::class, 'idusuario');
	}

	public function persona()
	{
		return $this->hasOne(Persona::class, 'idusuario');
	}

	public function punto()
	{
		return $this->hasOne(Punto::class, 'idusuario');
	}

	public function reciclaje()
	{
		return $this->hasOne(Reciclaje::class, 'idusuario');
	}
}
