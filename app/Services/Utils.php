<?php

namespace App\Services;

class Utils
{
    /**
     * Método para obtener un valor boolean en base al valor recibido de un
     * checkbox en un formulario
     * @param $value
     * @return bool
     */
    public function checkboxToBoolean ($value)
    {
        if ($value == 'on') {
            return true;
        } else {
            return false;
        }
    }
}
