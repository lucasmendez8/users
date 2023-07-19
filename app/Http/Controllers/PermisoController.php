<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index ()
    {
        $permisos = Permiso::where('activo', 1)->get();
        return view('auth.permisos.index', compact(
            'permisos'
        ));
    }
}
