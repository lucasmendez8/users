<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;


    /**
     * Los permisos del Modulo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permisos ()
    {
        return $this->hasMany(Permiso::class);
    }
}
