<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Permiso;
use App\Models\User;
use App\Models\UserPermiso;
use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->utils = new Utils();
    }

    /**
     * Listado de usuarios
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('listar-usuarios')) {
            $usuarios = User::paginate(10);
            return view('back.usuarios.index', compact('usuarios'));
        } else {
            return abort(401);
        }
    }

    /**
     * Muestra el formulario para crear un usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function new ()
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('crear-usuarios')) {
            return view('back.usuarios.new');
        } else {
            return abort(401);
        }
    }

    /**
     * Almacena un usuario
     * @param Request $request
     * @return void
     */
    public function store (Request $request)
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('crear-usuarios')) {
            //Valida
            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required | confirmed | min:6',
                'password_confirmation' => 'required',
            ], [
                'nombre.required' => 'Este campo es requerido.',
                'apellido.required' => 'Este campo es requerido.',
                'username.required' => 'Este campo es requerido.',
                'username.unique' => 'Nombre de usuario no disponible.',
                'email.required' => 'Este campo es requerido.',
                'email.unique' => 'Ya existe un usuario con el email ingresado.',
                'password.required' => 'Este campo es requerido.',
                'password.confirmed' => 'Los passwords ingresados deben coincidir.',
                'password.min' => 'El password debe contener al menos 6 caracteres.',
                'password_confirmation.required' => 'Este campo es requerido'
            ]);

            //Guarda
            $usuario = new User();
            $usuario->nombre = $request->get('nombre');
            $usuario->apellido = $request->get('apellido');
            $usuario->username = $request->get('username');
            $usuario->password = Hash::make($request->get('password'));
            $usuario->email = $request->get('email');
            $usuario->primer_login = true;
            $usuario->super_admin = $this->utils->checkboxToBoolean($request->get('super_admin'));
            $usuario->activo = $this->utils->checkboxToBoolean($request->get('activo'));

            if ($usuario->save()) {
                return redirect()->route('usuarios')->with('success', 'El usuario ha sido creado.');
            }
        } else {
            return abort(401);
        }
    }


    /**
     * Muestra el form para editar un usuario
     * @param User $usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit (User $usuario)
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('editar-usuarios') || Auth::user()->id == $usuario->id) {
            return view('back.usuarios.edit', compact('usuario'));
        } else {
            return abort(401);
        }
    }


    /**
     * Actualiza un usuario creado
     * @param User $usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update (User $usuario, Request $request)
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('editar-usuarios') || Auth::user()->id == $usuario->id) {
            //Valida
            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'username' => 'required | unique:users,username,'.$usuario->id,
                'email' => 'required | unique:users,email,'.$usuario->id
            ], [
                'nombre.required' => 'Este campo es requerido.',
                'apellido.required' => 'Este campo es requerido.',
                'username.required' => 'Este campo es requerido.',
                'username.unique' => 'Nombre de usuario no disponible.',
                'email.required' => 'Este campo es requerido.',
                'email.unique' => 'Ya existe un usuario con el email ingresado.'
            ]);

            //Guarda
            $usuario->nombre = $request->get('nombre');
            $usuario->apellido = $request->get('apellido');
            $usuario->username = $request->get('username');
            $usuario->email = $request->get('email');

            //Se verifica si el form tiene estos campos, ya que son visibles segun el permiso del usuario
            if ($request->has('super_admin')) {
                $usuario->super_admin = $this->utils->checkboxToBoolean($request->get('super_admin'));
            }

            if ($request->has('activo')) {
                $usuario->activo = $this->utils->checkboxToBoolean($request->get('activo'));
            }

            if ($usuario->update()) {
                return redirect(url($request->get('redirect')))->with('success', 'El usuario ha sido actualizado.');
            }
        } else {
            return abort(401);
        }
    }


    /**
     * Si es el primer login del usuario se le solicita actualizar el password
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function primerLogin(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return view('back.usuarios.primerLogin', compact('user'));
        } else {
            return abort(401);
        }
    }


    /**
     * Se setea el password del usuario que se loguea por primera vez
     * @param User $usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|never|void
     */
    public function setearPassword (User $usuario, Request $request)
    {
        //Se verifica que el usuario este logueado y que coincida con el que solicita el password
        if (Auth::user() && (Auth::user()->id = $request->get('usuario'))) {
            //Valida
            $request->validate([
                'password' => 'required | confirmed | min:6',
                'password_confirmation' => 'required',
            ], [
                'password.required' => 'Este campo es requerido.',
                'password.confirmed' => 'Los passwords ingresados deben coincidir.',
                'password.min' => 'El password debe contener al menos 6 caracteres.',
                'password_confirmation.required' => 'Este campo es requerido'
            ]);

            $usuario->password = Hash::make($request->get('password'));
            $usuario->primer_login = false;

            if ($usuario->update()) {
                return redirect()->route('auth.home')->with('success', 'El password ha sido actualizado.');
            }

        } else {
            return abort(401);
        }
    }


    /**
     * Devuelve el formulario para actualizar el password de un usuario logueado
     * @param User $usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cambiarPassword ()
    {
        $usuario = Auth::user();
        if ($usuario) {
            return view('back.usuarios.modificarPassword', ['usuario' => $usuario]);
        } else {
            abort(401);
        }
    }


    /**
     * Muestra el form para editar permisos de un usuario
     * @param User $usuario
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editPermisos (User $usuario)
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('asignar-permisos')) {
            $modulos = Modulo::orderBy('nombre')->get();

            $userPermisos = UserPermiso::select('permiso_id')->where('user_id', $usuario->id)->get();
            $arrPermisos = [];

            foreach ($userPermisos as $permiso) {
                $arrPermisos[] = $permiso->permiso_id;
            }

            return view('back.usuarios.permisos', compact('arrPermisos', 'modulos', 'usuario'));
        } else {
            return abort(401);
        }
    }


    /**
     * Guardar los permisos de usuario
     * @param User $usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermisos (User $usuario, Request $request)
    {
        if (Auth::user()->super_admin || Auth::user()->hasPermiso('asignar-permisos')) {
            $permisos = Permiso::all();

            //Borrar todos los permisos del usuario logueado
            UserPermiso::where('user_id', $usuario->id)->delete();

            //Se verifican los permisos con check en el form
            foreach ($permisos as $permiso) {
                //Si tiene el permiso se guarda
                if ($request->has($permiso->slug)) {
                    $userPermiso = new UserPermiso();
                    $userPermiso->user_id = $usuario->id;
                    $userPermiso->permiso_id = $permiso->id;
                    $userPermiso->save();
                }
            }

            return redirect()->route('usuarios')->with('success', 'Los permisos del usuario han sido actualizados.');
        } else {
            return abort(401);
        }
    }
}
