<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Barryvdh\Debugbar\Facade as Debugbar;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        
        // Validate status
        if($user->status == '0'){
            auth()->logout();
            return redirect()->back()->withInput()->withMessage('La cuenta se encuentra inactiva');
        }

        // Save attempt
//        $ingreso = new Ingreso();
//        $ingreso->IdUsuario = Auth::user()->IdUsuario;
//        $ingreso->Fecha = date("Y-m-d H:i:s");
//        $ingreso->Ip = $request->ip();
//        $ingreso->UserAgent = $request->header('User-Agent');
//        $ingreso->IdSession = $request->session()->getId();
//        $ingreso->IndRegistro = 'A';
//        $ingreso->UsuarioCreacion = Auth::user()->IdUsuario;
//        $ingreso->save();

        return redirect()->intended($this->redirectPath());
    }
    
    protected function loggedOut() {
        return redirect()->route('login');
    }
    
}
