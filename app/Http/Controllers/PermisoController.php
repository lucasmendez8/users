<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Permiso;
use App\Services\Utils;
use Illuminate\Http\Request;
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
        return view('back.permisos.new', compact('modulo'));
    }


    /**
     * Se guarda un nuevo permiso
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store (Request $request)
    {
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
            return redirect()->route('modulos.edit', ['modulo' => $request->get('modulo_id')]);
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
        return view('back.permisos.edit', compact('modulo', 'permiso'));
    }


    /**
     * Se actualiza el permiso
     * @param Permiso $permiso
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update (Permiso $permiso, Request $request)
    {
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
//
        if ($permiso->update()) {
            return redirect()->route('modulos.edit', ['modulo' => $request->get('modulo_id')]);
        }
    }
}
