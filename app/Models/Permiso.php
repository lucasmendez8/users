<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    /**
     * Permiso tiene un modulo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulo ()
    {
        return $this->belongsTo(Modulo::class);
    }
}
