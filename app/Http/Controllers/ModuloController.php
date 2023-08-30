<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuloRequest;
use App\Models\Modulo;
use App\Models\Permiso;
use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ModuloController extends Controller
{

    public function __construct()
    {
        $this->utils = new Utils();
    }

    /**
     * Muestra un listado con todos los módulos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        if (Auth::user()->super_admin) {
            $modulos = Modulo::paginate(10);
            return view('back.modulos.index', compact('modulos'));
        } else {
            return abort(401);
        }
    }


    /**
     * Devuelve formulario para crear un nuevo modulo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function new ()
    {
        if (Auth::user()->super_admin) {
            return view('back.modulos.new');
        } else {
            return abort(401);
        }
    }


    /**
     * Crea un nuevo modulo
     * @param Request $request
     * @return string|void
     */
    public function store (Request $request)
    {
        if (Auth::user()->super_admin) {
            //Validacion
            $request->validate([
                'nombre' => 'required | unique:modulos'
            ], [
                'nombre.required' => 'Este campo es requerido.',
                'nombre.unique' => 'Ya existe un modulo con el nombre ingresado.'
            ]);

            //Guardado
            $modulo = new Modulo();
            $modulo->nombre = $request->get('nombre');
            $modulo->slug = Str::slug($modulo->nombre);
            $modulo->activo = $this->utils->checkboxToBoolean($request->get('activo'));

            if ($modulo->save()) {
                return redirect()->route('modulos')->with('success', 'El módulo ha sido creado.');
            }
        } else {
            return abort(401);
        }
    }

    /**
     * Muestra el form para editar un modulo
     * @param Modulo $modulo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit (Modulo $modulo)
    {
        if (Auth::user()->super_admin) {
            $permisos = Permiso::where('modulo_id', $modulo->id)->get();
            return view('back.modulos.edit', compact('modulo', 'permisos'));
        } else {
            return abort(401);
        }
    }


    /**
     * Actualizar un modulo
     * @param Modulo $modulo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update (Modulo $modulo, Request $request)
    {
        if (Auth::user()->super_admin) {
            //Validacion
            $request->validate([
                'nombre' => 'required | unique:modulos,nombre,'.$modulo->id
            ], [
                'nombre.required' => 'Este campo es requerido.',
                'nombre.unique' => 'Ya existe un modulo con el nombre ingresado.'
            ]);

            //Guardado
            $modulo->nombre = $request->get('nombre');
            $modulo->slug = Str::slug($modulo->nombre);
            $modulo->activo = $this->utils->checkboxToBoolean($request->get('activo'));

            if ($modulo->update()) {
                return redirect()->route('modulos')->with('success', 'El módulo ha sido actualizado.');
            }
        } else {
            return abort(401);
        }
    }
}
