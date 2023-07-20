<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuloRequest;
use App\Models\Modulo;
use App\Services\Utils;
use Illuminate\Http\Request;
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
        $modulos = Modulo::paginate(10);
        return view('back.modulos.index', compact('modulos'));
    }


    /**
     * Devuelve formulario para crear un nuevo modulo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function new ()
    {
        return view('back.modulos.new');
    }


    /**
     * Crea un nuevo modulo
     * @param Request $request
     * @return string|void
     */
    public function store (Request $request)
    {
        //Validacion
        $request->validate([
            'nombre' => 'required | unique:modulos'
        ], [
            'nombre.required' => 'Debe ingresar un nombre',
            'nombre.unique' => 'Ya existe un modulo con el nombre ingresado.'
        ]);

        //Guardado
        $modulo = new Modulo();
        $modulo->nombre = $request->get('nombre');
        $modulo->slug = Str::slug($modulo->nombre);
        $modulo->activo = $this->utils->checkboxToBoolean($request->get('activo'));

        if ($modulo->save()) {
            return redirect()->route('modulos');
        }
    }

    /**
     * Muestra el form para editar un modulo
     * @param Modulo $modulo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit (Modulo $modulo)
    {
        return view('back.modulos.edit', compact('modulo'));
    }


    /**
     * Actualizar un modulo
     * @param Modulo $modulo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update (Modulo $modulo, Request $request)
    {
        //Validacion
        $request->validate([
            'nombre' => 'required | unique:modulos,nombre,'.$modulo->id
        ], [
            'nombre.required' => 'Debe ingresar un nombre',
            'nombre.unique' => 'Ya existe un modulo con el nombre ingresado.'
        ]);

        //Guardado
        $modulo->nombre = $request->get('nombre');
        $modulo->slug = Str::slug($modulo->nombre);
        $modulo->activo = $this->utils->checkboxToBoolean($request->get('activo'));

        if ($modulo->update()) {
            return redirect()->route('modulos');
        }
    }
}
