<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function Bitacora(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = Bitacora::join('Empleados', 'Bitacora.IdEmpleado', '=', 'Empleados.Id')
                ->where('Empleados.NumeroEmpleado', $request->NumEmpleado)
                ->get();

        } catch (\Exception $e) {
            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            [
                'NUMCODE' => $NUMCODE,
                'STRMESSAGE' => $STRMESSAGE,
                'RESPONSE' => $response,
                'SUCCESS' => $SUCCESS,
            ]);

    }

    public function Bitacorafull(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = Bitacora::all();

        } catch (\Exception $e) {
            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            [
                'NUMCODE' => $NUMCODE,
                'STRMESSAGE' => $STRMESSAGE,
                'RESPONSE' => $response,
                'SUCCESS' => $SUCCESS,
            ]);

    }
}
