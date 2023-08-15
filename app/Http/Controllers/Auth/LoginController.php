<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login con username
     * @return string
     */
    public function username()
    {
        return 'username';
    }

//    /**
//     * Sobreescribe metodo de login para verificar primer login de un usuario creado
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
//     * @throws \Illuminate\Validation\ValidationException
//     */
//    public function login(Request $request)
//    {
//        $this->validateLogin($request);
//
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        if (method_exists($this, 'hasTooManyLoginAttempts') &&
//            $this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }
//
//        //Check si es primer login del usuario
//        if ($this->primerLogin($request->get($this->username()))) {
//            //Redireccionar a forzar cambio de password
//            return redirect()->route('usuarios.primerLogin', [
//                'username' => Crypt::encrypt($request->get($this->username())),
//                'primer_login' => true
//            ]);
//        } else {
//            //Continua proceso normal de login de laravel
//            if ($this->attemptLogin($request)) {
//                if ($request->hasSession()) {
//                    $request->session()->put('auth.password_confirmed_at', time());
//                }
//
//                return $this->sendLoginResponse($request);
//            }
//
//            // If the login attempt was unsuccessful we will increment the number of attempts
//            // to login and redirect the user back to the login form. Of course, when this
//            // user surpasses their maximum number of attempts they will get locked out.
//            $this->incrementLoginAttempts($request);
//
//            return $this->sendFailedLoginResponse($request);
//        }
//    }
//
//
//    protected function primerLogin ($username)
//    {
//        $user = User::where('username', $username)->first();
//        return $user->primer_login;
//    }
}
