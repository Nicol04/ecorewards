<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombreUsuario' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:usuario'],
            'password' => ['required', 'string', 'min:8', 'max:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        ]);
    }

    protected function create(array $data)
    {
        return Usuario::create([
            'nombreUsuario' => $data['nombreUsuario'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
