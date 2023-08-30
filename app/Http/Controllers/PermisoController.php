<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Permiso;
use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PermisoController extends Controller
{

    public function __construct()
    {
        $this->utils = new Utils();
    }

    /**
     * Muestra form para crear un nuevo permiso
     * @param Modulo $modulo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function new (Modulo $modulo)
    {
        if (Auth::user()->super_admin) {
            return view('back.permisos.new', compact('modulo'));
        } else {
            return abort(401);
        }
    }


    /**
     * Se guarda un nuevo permiso
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store (Request $request)
    {
        if (Auth::user()->super_admin) {
            //validacion
            $request->validate([
                'nombre' => 'required | unique:permisos',
                'nombre_corto' => 'required',
            ], [
                'nombre.required' => 'Debe ingresar un nombre.',
                'nombre.unique' => 'Ya existe un permiso con el nombre ingresado',
                'nombre_corto.required' => 'Debe ingresar un nombre corto.'
            ]);

            //guardado
            $permiso = new Permiso();
            $permiso->nombre = $request->get('nombre');
            $permiso->nombre_corto = $request->get('nombre_corto');
            $permiso->slug = Str::slug($permiso->nombre);
            $permiso->modulo_id = $request->get('modulo_id');
            $permiso->activo = $this->utils->checkboxToBoolean($request->get('activo'));

            if ($permiso->save()) {
                return redirect()->route('modulos.edit', ['modulo' => $request->get('modulo_id')])
                    ->with('success', 'El permiso ha sido creado.');
            }
        } else {
            return abort(401);
        }
    }

    /**
     * Muestra el formulario para editar un permiso
     * @param Modulo $modulo
     * @param Permiso $permiso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit (Modulo $modulo, Permiso $permiso)
    {
        if (Auth::user()->super_admin) {
            return view('back.permisos.edit', compact('modulo', 'permiso'));
        } else {
            return abort(401);
        }

    }


    /**
     * Se actualiza el permiso
     * @param Permiso $permiso
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update (Permiso $permiso, Request $request)
    {
        if (Auth::user()->super_admin) {
            //validacion
            $request->validate([
                'nombre' => 'required | unique:permisos,nombre,'.$permiso->id,
                'nombre_corto' => 'required',
            ], [
                'nombre.required' => 'Debe ingresar un nombre.',
                'nombre.unique' => 'Ya existe un permiso con el nombre ingresado',
                'nombre_corto.required' => 'Debe ingresar un nombre corto.'
            ]);

            //guardado
            $permiso->nombre = $request->get('nombre');
            $permiso->nombre_corto = $request->get('nombre_corto');
            $permiso->slug = Str::slug($permiso->nombre);
            $permiso->modulo_id = $request->get('modulo_id');
            $permiso->activo = $this->utils->checkboxToBoolean($request->get('activo'));

            if ($permiso->update()) {
                return redirect()->route('modulos.edit', ['modulo' => $request->get('modulo_id')])
                    ->with('success', 'El permiso ha sido editado.');
            }
        } else {
            return abort(401);
        }
    }
}
