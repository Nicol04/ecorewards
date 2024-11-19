<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function username()
    {
        return 'nombreUsuario';
    }
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Mensaje tras inicio exitoso
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo)
            ->with('mensaje', 'Inicio de sesión exitoso')
            ->with('icono', 'success');
    }
    
}