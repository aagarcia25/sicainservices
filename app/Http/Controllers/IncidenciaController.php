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
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ])));

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
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ])));

    }

    public function totalincidencias(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
            SELECT COUNT(1) total FROM SICAIN.Incidencias
            ');

        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ])));

    }

    public function Incidenciasporfecha(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
           SELECT COUNT(1) total,FechaCreacion FROM SICAIN.Incidencias group BY FechaCreacion
            ');

        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ])));

    }

}
