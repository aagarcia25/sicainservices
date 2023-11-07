<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncidenciaController extends Controller
{

    public function incidencia(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $datosIncidencia = [
                'Foto' => $request->Foto,
                'Observaciones' => $request->Observaciones,
                'IdEmpleado' => $request->IdEmpleado,
            ];

            $response = Incidencia::create($datosIncidencia);

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

    public function incidenciaList(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
              SELECT inc.*,
                     emp.NumeroEmpleado,
                     emp.Nombre,
                     emp.ApellidoP,
                     emp.ApellidoM,
                     emp.RazonSocial
               FROM SICAIN.Incidencias inc
               LEFT JOIN SICAIN.Empleados emp ON emp.Id = inc.IdEmpleado
            ');

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
