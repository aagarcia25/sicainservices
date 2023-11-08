<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{

    public function Registra(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {
            $fecha = Carbon::now('America/Monterrey');

            if ($request->Tipo == 1) {
                $bitacora = new Bitacora();
                // Generar un nuevo UUID para el registro
                $bitacora->Id = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $bitacora->IdEmpleado = $request->idEmpleado;
                $bitacora->Fecha = $fecha;
                $bitacora->HoraEntrada = $fecha->format('H:i:s');
                $bitacora->Completado = 0;
                $bitacora->save();

            } else {
                $bitacora = Bitacora::find($request->idbitacora);
                $bitacora->IdEmpleado = $request->idEmpleado;
                $bitacora->HoraSalida = $fecha->format('H:i:s');
                $bitacora->Completado = 1;
                $bitacora->save();

            }

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

    public function Bitacora(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
                  SELECT
                  tbl.Id,
                  tbl.IdEmpleado,
                  tbl.fecha,
                  tbl.HoraEntrada,
                  tbl.HoraSalida,
                  tbl.Completado
                  FROM SICAIN.Bitacora tbl
                  where tbl.IdEmpleado=?
                  order by FechaCreacion desc
            ', [$request->idEmpleado]);

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

            $response = DB::select('
    SELECT
        tbl.Id,
        tbl.IdEmpleado,
        tbl.Fecha,
        tbl.HoraEntrada,
        tbl.HoraSalida,
        CASE
            WHEN tbl.Completado = 0 THEN "En Turno"
            WHEN tbl.Completado = 1 THEN "Turno Terminado"
            ELSE "Estado Desconocido"
        END AS Completado,
        emp.NumeroEmpleado,
        emp.Nombre,
        emp.ApellidoP,
        emp.ApellidoM,
        emp.RazonSocial
    FROM
        SICAIN.Bitacora tbl
    LEFT JOIN
        SICAIN.Empleados emp ON tbl.IdEmpleado = emp.Id
    ORDER BY
        tbl.Fecha
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

    public function BitacoraSingle(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {
            $response = Bitacora::where('IdEmpleado', $request->NumEmpleado)
                ->where('Completado', 0)
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
}
